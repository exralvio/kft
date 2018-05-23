<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectID;
use App\Models\Media;

class MediaFresh extends Eloquent
{
    protected $collection = 'media_fresh';

    public static function insertFresh($media){
    	$find = MediaFresh::raw()->count(['user.id'=>$media['user']['id'], 'created_date'=>$media['created_date']]);

    	if($find){
    		return false;
    	}

    	$fresh = new MediaFresh();
    	$fresh->media = [
    		'id'=> new ObjectID($media['_id']),
            'created_at'=> $media['created_at']->format('c')
        ];

        $fresh->images = $media['images'];
    	$fresh->user = $media['user'];
    	$fresh->title = $media['title'];
    	$fresh->category = $media['category'];
    	$fresh->like_count = $media['like_count'];
    	$fresh->created_date = $media['created_date'];

    	$fresh->save();

        return true;
    }

    public function isLiked($user_id){
        $media = Media::find($this->media['id']);
        $like_users = !empty($media) ? $media->like_users : [];
        if(in_array($user_id, array_map(function($v){ return $v['user_id']; }, $like_users))){
            return true;
        }else{
            return false;
        }
    }

    public static function updateMedia($media){
        $fresh = MediaFresh::where(['media.id'=>new ObjectID($media['_id'])])->first();

        if($fresh){        
        	$fresh->like_count = $media->like_count;
        	$fresh->save();
        }
    }
}
