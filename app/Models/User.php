<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectID;

class User extends Eloquent
{
    protected $collection = 'users';

    public static function current(){
        $sess = session('user');

        $user = User::raw()->findOne(['_id'=>$sess['_id']]);
        
        $firstname = $user['firstname'];
        $lastname = $user['lastname'];
        $email = $user['email'];
        $photo = $user['photo'];
        $_id = $user['_id'];

        return compact('_id','firstname','lastname','email','photo');
    }

    public static function currentPhoto(){
    	$sess = session('user');

    	$user = User::raw()->findOne(['_id'=>$sess['_id']]);

    	return $user['photo'];
    }

    public static function name($firstname, $lastname){
    	return empty($lastname) ? $firstname : $firstname.' '.$lastname;
    }

    public static function updateUserPhoto($user_id, $photo){
        /** Update user media **/
        $medias = \App\Models\Media::raw()->find(['user.id'=>$user_id]);

        if($medias){
            foreach ($medias as $media) {
                \DB::collection('medias')->where('_id', $media['_id'])->update(['user.photo'=>$photo]);
            }   
        }

        /** Update user comments **/
        $comments = \App\Models\Comment::raw()->find(['user.id'=>$user_id]);

        if($comments){
            foreach ($comments as $comment) {
                \DB::collection('comments')->where('_id', $comment['_id'])->update(['user.photo'=>$photo]);
            }   
        }
    }

    public static function isFollower($user_id){
        $current_id = User::current()['_id'];
        $user_id = new ObjectID($user_id);

        $followed = \App\Models\Following::raw()->findOne(['user_id'=>$current_id, 'followings.id'=>$user_id]);

        return $followed ? true : false;
    }
}
