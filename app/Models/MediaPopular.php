<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectID;

class MediaPopular extends Eloquent
{
    protected $collection = 'media_popular';

    public static function updateMedia($media){
        $popular = MediaPopular::where(['media.id'=>new ObjectID($media['_id'])])->first();

        if($media['like_count'] >= 10){
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
    	$popular_threshold = 7;

    	$popular = new MediaPopular();
    	$popular->media = [
    		'id'=> new ObjectID($media['_id']),
            'created_at'=> $media['created_at']->format('c')
        ];
        $popular->images = $media['images'];
    	$popular->user = $media['user'];
    	$popular->title = $media['title'];
    	$popular->category = $media['category'];
    	$popular->popular_threshold = now()->addDays($popular_threshold)->format('Y-m-d H:i:s');
    	$popular->like_count = $media['like_count'];

    	$popular->save();
    }

    public static function updateLikeCount($media){
    	$popular = MediaPopular::where(['media.id'=>new ObjectID($media['_id'])])->first();
    	$popular->like_count = $media->like_count;
    	$popular->save();
      
    }

    public function getName(){
        return !empty($this->user['firstname']) ? $this->user['firstname'].' '.$this->user['lastname'] : $this->user['firstname'];
    }
}
