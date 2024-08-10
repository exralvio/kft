<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectID;
use App\Models\Media;

class MediaPopular extends Eloquent
{
    protected $collection = 'media_popular';

    public static function updateMedia($media){
        $popular = MediaPopular::where(['media.id'=>new ObjectID($media['_id'])])->first();

        $popular_like_threshold = \App\Models\Setting::valueOf('popular_like_threshold');

        if($media['like_count'] >= $popular_like_threshold){
            if($popular){
                MediaPopular::updateLikeCount($media);
                return;
            } 

            MediaPopular::addNewMedia($media);
            return;
        } else {
            if($popular){
                MediaPopular::destroy($popular['_id']);
                return;   
            }
        }
    }

    public static function addNewMedia($media){
    	$popular_duedate = \App\Models\Setting::valueOf('popular_duedate');;

    	$popular = new MediaPopular();
    	$popular->media = [
    		'id'=> new ObjectID($media['_id']),
            'created_at'=> $media['created_at']->format('c')
        ];
        $popular->images = $media['images'];
    	$popular->user = $media['user'];
    	$popular->title = $media['title'];
    	$popular->category = $media['category'];
    	$popular->popular_threshold = now()->addDays($popular_duedate)->format('Y-m-d H:i:s');
    	$popular->like_count = $media['like_count'];

    	$popular->save();

        /** Send Notification **/
        \NotificationHelper::setNotification('popular', $popular->user['id'], $popular->user['id'], 
            [
                'id'=>$popular->media['id'], 
                'title'=>$popular->title
            ]
        );
        /** End Send Notification **/
    }

    public static function updateLikeCount($media){
    	$popular = MediaPopular::where(['media.id'=>new ObjectID($media['_id'])])->first();
    	$popular->like_count = $media->like_count;
    	$popular->save();
      
    }

    public function isLiked($user_id){
        $media = Media::find($this->media['id']);
        if(in_array($user_id, array_map(function($v){ return $v['user_id']; }, $media->like_users))){
            return true;
        }else{
            return false;
        }
    }

    public function isSelfBelong($user_id){
        $media = Media::find($this->media['id']);
        if($media->user['id'] == $user_id)
            return true;

        return false;
    }
}
