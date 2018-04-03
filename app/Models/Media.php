<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Users;
use App\Models\MediaCategory;
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
    }

    public function getName(){
        return !empty($this->user['firstname']) ? $this->user['firstname'].' '.$this->user['lastname'] : $this->user['firstname'];
    }

    public static function discoverFresh(){
        return Media::get()->sortBy('created_at', null, true);
    }

    public static function discoverPopular(){
        $medias = MediaPopular::where('popular_threshold', '>=', now()->format('Y-m-d H:i:s'))->get()->sortBy('view_count', null, true);

        return $medias;
    }

    public static function selfMedia($user_id = null){
        if(!empty($user_id)){
            $user = User::find($user_id);
        } else {
            $user = User::current();
        }

        $medias = Media::where('user.id', new ObjectID((string) $user['_id']))->get()->sortBy('created_at', null, true);

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
}
