<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Media;

class Comment extends Eloquent
{
    protected $collection = 'comments';

    public function updateMedia($action){
    	$media_id = $this->photo_id;

	    $media = Media::find($media_id);

    	if($action == 'add'){
	    	$media->comment_count += 1;
    	} else if($action == 'remove'){
    		if($media->comment_count >= 1){
	    		$media->comment_count -= 1;
    		}
    	}

	    $media->save();
    }
}
