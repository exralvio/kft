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
    		'firstname'=>$user['firstname'],
    		'lastname'=>$user['lastname'],
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
	    	$media->category = ['id'=>$category['_id'], 'name'=>$category['name']];
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

    public static function freshMedia(){
        return Media::get()->sortBy('created_at', null, true);
    }

    public static function popularMedia(){
        return Media::get()->sortBy('view_count', null, true);
    }
}
