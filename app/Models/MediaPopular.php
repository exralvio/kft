<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectID;

class MediaPopular extends Eloquent
{
    protected $collection = 'media_popular';

    public static function addNewMedia($media){
    	$popular_threshold = 7;

    	$popular = new MediaPopular();
    	$popular->media = [
    		'id'=> new ObjectID($media['_id']),
            'created_at'=> $media['created_at']
        ];
        $popular->images = $media['images'];
    	$popular->user = $media['user'];
    	$popular->title = $media['title'];
    	$popular->category = $media['category'];
    	$popular->popular_threshold = now()->addDays($popular_threshold)->format('Y-m-d H:i:s');
    	$popular->view_count = 0;

    	$popular->save();
    }

    public static function updatePopularView($media){
    	$popular = MediaPopular::where(['media.id'=>new ObjectID($media['_id'])])->first();

        if($popular){        
        	$popular->view_count = $media->view_count;
        	$popular->save();
        }
    }

    public function getName(){
        return !empty($this->user['firstname']) ? $this->user['firstname'].' '.$this->user['lastname'] : $this->user['firstname'];
    }
}
