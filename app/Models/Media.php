<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Users;
use App\Models\MediaCategory;
use App\Models\MediaFresh;
use MongoDB\BSON\ObjectID;

class Media extends Eloquent
{
    protected $collection = 'medias';

    public static function saveUpload(array $data){
    	$user = User::current();

		$media = new Media;
    	$media->user = [
    		'id'=>$user['_id'],
            'fullname'=>$user['fullname'],
    		'photo'=>$user['photo']
    	];

    	$media->like_count = 0;
    	$media->like_users = [];
    	$media->images = $data['images'];
    	$media->view_count = 0;
    	$media->title = !empty($data['title']) ? $data['title'] : 'Untitled';
    	$media->description = $data['description'];
        $media->created_date = date('Y-m-d');

    	if(!empty($data['category'])){
    		$category = MediaCategory::raw()->findOne(['_id'=>new ObjectID($data['category'])]);
	    	$media->category = ['id'=>(string) $category['_id'], 'name'=>$category['name']];
    	} else {
	    	$media->category = ['id'=>'', 'name'=>'Uncategorized'];
    	}

    	$media->exif = !empty($data['exif']) ? $data['exif'] : [];
    	$media->comment_count = 0;
    	$media->keywords = !empty($data['keywords']) ? $data['keywords'] : [];
    	$media->save();

        MediaFresh::insertFresh($media);
    }

    public static function discoverFresh($limit = 0){
        return Media::orderBy('_id','desc')->limit($limit)->get();
    }

    public static function discoverPopular($limit = 0){
        $medias = MediaPopular::orderBy('like_count','desc')->where('popular_threshold', '>=', now()->format('Y-m-d H:i:s'))->limit($limit)->get();

        return $medias;
    }

    public static function selfMedia($user_id = null){
        if(!empty($user_id)){
            $user = User::find($user_id);
        } else {
            $user = User::current();
        }

        $medias = Media::orderBy('_id', 'desc')->where('user.id', new ObjectID((string) $user['_id']))->get();

        return $medias;
    }

    public static function selfMediaCount($media_type = null){
        $user = User::current();
        $count = Media::where('user.id', $user['_id'])->count();

        return $count;
    }

    public function updateView(){
        $this->view_count += 1;
        $this->save();

        \App\Models\User::updateView($this->user['id']);
    }

    public function updateLike($action){
        $user = User::current();

        if($action == 'like'){
            $this->push('like_users', [
                "user_id"=> $user['_id'],
                "fullname"=> $user['fullname'],
                "created_at"=> now()->format('c')
            ]);

            $this->like_count += 1;

            if($this->save()){
                /** Send Notification **/
                \NotificationHelper::setNotification('like', $user['_id'], $this->user['id'], 
                    [
                        "id"=> $this->_id,
                        "title"=> $this->title,
                    ]
                );
                /** End Send Notification **/

                /** Update Popular Post **/
                MediaPopular::updateMedia($this);
                MediaFresh::updateMedia($this);
                /** End Update Popular **/

                return true;
            }
        } elseif($action == 'unlike'){
            if(in_array($user['_id'], array_map(function($v){ return $v['user_id']; }, $this->like_users))){
                $this->pull('like_users', ["user_id"=> $user['_id']]);
                $this->like_count -= 1;

                if($this->save()){
                    /** Update Popular Post **/
                    MediaPopular::updateMedia($this);
                    MediaFresh::updateMedia($this);
                    /** End Update Popular **/
                    
                    return true;
                }
            }
        }

        return false;
    }

    public function isLiked($user_id){
        if(in_array($user_id, array_map(function($v){ return $v['user_id']; }, $this->like_users))){
            return true;
        }else{
            return false;
        }
    }

    public function isSelfBelong($user_id){
        if($this->user['id'] == $user_id)
            return true;

        return false;
    }

    public function updateRelated(){
        $media = $this;
        $fresh = MediaFresh::where(['media.id'=>new ObjectID($media['_id'])])->first();

        if($fresh){
            $fresh->images = $media['images'];
            $fresh->user = $media['user'];
            $fresh->title = $media['title'];
            $fresh->category = $media['category'];
            $fresh->like_count = $media['like_count'];
            $fresh->save();
        }

        $popular = MediaPopular::where(['media.id'=>new ObjectID($media['_id'])])->first();

        if($popular){
            $popular->images = $media['images'];
            $popular->user = $media['user'];
            $popular->title = $media['title'];
            $popular->category = $media['category'];
            $popular->like_count = $media['like_count'];
            $popular->save();
        }
    }
}
