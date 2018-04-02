<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectID;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Eloquent implements 
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    protected $collection = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id'
    ];

    public static function current(){
        $sess = session('user');

        $user = User::raw()->findOne(['_id'=>$sess['_id']]);
        
        $firstname = $user['firstname'];
        $lastname = $user['lastname'];
        $fullname = $user['fullname'];
        $email = $user['email'];
        $photo = $user['photo'];
        $_id = $user['_id'];
        $department = $user['department'];
        $birthday = $user['birthday'];
        $about = $user['about'];
        $gender = $user['gender'];

        return compact('_id','firstname','lastname','fullname','email','photo','department','birthday','gender','about');
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

    public static function getFollowing($timeline = false){
        $user = User::current();
        $user_id = $user['_id'];

        $following = \App\Models\Following::where('user_id', $user_id)->first();
        if(isset($following)){
            $followings = array_map(function($v){ return $v['id']; }, (array) $following->followings);
        }else{
            $followings = [];
        }

        if($timeline){
            array_push($followings, $user_id);
        }

        return $followings;
    }

    public function getFollowerCount($user_id = null){
        if(!isset($user_id)){
            $user_id = new ObjectID($this->_id);
        }

        $follower = \App\Models\Followed::where('user_id', $user_id)->first();

        if($follower){
            return count($follower['followers']);
        }

        return 0;
    }

    public function getFollowingCount($user_id = null){
        if(!isset($user_id)){
            $user_id = new ObjectID($this->_id);
        }

        $following = \App\Models\Following::where('user_id', $user_id)->first();

        if($following){
            return count($following['followings']);
        }

        return 0;
    }

    public static function updateView($user_id){
        $user = User::where(['_id'=>$user_id])->first();
        if($user){
            $user->view_count += 1;
            $user->save();
        }
    }
}
