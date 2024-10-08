<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectID;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MailResetPassword;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable implements CanResetPasswordContract{

    use Notifiable, CanResetPassword;
    protected $collection = 'users';

    protected $fillable = [
        'email', 'password', 'provider', 'provider_id','is_active', 'firstname','lastname','fullname','email','photo','department','birthday','gender','about'
    ];

    public static function current(){
        $sess = \Auth::user();

        if(!$sess){
            return false;
        }

        $user = User::raw()->findOne(['_id'=>new ObjectId($sess['_id'])]);
        
        $firstname = $user['firstname'];
        $lastname = $user['lastname'];
        $fullname = $user['fullname'];
        $email = $user['email'];
        $photo = $user['photo'];
        $_id = $user['_id'];
        $department = $user['department'];
        $company = $user['company'];
        $sister_company = $user['sister_company'];
        $birthday = $user['birthday'];
        $about = $user['about'];
        $gender = $user['gender'];
        $is_active = $user['is_active'];

        return compact('_id','firstname','lastname','fullname','email','photo','department','company','sister_company','birthday','gender','about','is_active');
    }

    public static function isActive(){
        $user = User::current();

        return $user['is_active'];
    }

    public static function currentPhoto(){
    	$sess = session('user');

    	$user = User::raw()->findOne(['_id'=> new ObjectId($sess['_id'])]);

    	return $user['photo'];
    }

    public static function name($firstname, $lastname){
    	return empty($lastname) ? $firstname : $firstname.' '.$lastname;
    }

    public static function updateUserPhoto($user_id, $photo){
        /** Update user media **/
        $datas = \App\Models\Media::raw()->find(['user.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('medias')->where('_id', $data['_id'])->update(['user.photo'=>$photo]);
            }   
        }

        /** Update user comments **/
        $datas = \App\Models\Comment::raw()->find(['user.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('comments')->where('_id', $data['_id'])->update(['user.photo'=>$photo]);
            }   
        }

        /** Update sender notification **/
        $datas = \App\Models\Notification::raw()->find(['sender.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('notifications')->where('_id', $data['_id'])->update(['sender.photo'=>$photo]);
            }   
        }

        /** Update receiver notification **/
        $datas = \App\Models\Notification::raw()->find(['receiver.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('notifications')->where('_id', $data['_id'])->update(['receiver.photo'=>$photo]);
            }   
        }

        /** Update user media popular **/
        $datas = \App\Models\MediaPopular::raw()->find(['user.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('media_popular')->where('_id', $data['_id'])->update(['user.photo'=>$photo]);
            }   
        }

        /** Update user following **/
        $datas = \App\Models\Following::raw()->find(['followings.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('following')->where(['followings.id'=>$user_id])->update(['followings.$.photo'=>$photo]);
            }   
        }

        /** Update user followed **/
        $datas = \App\Models\Followed::raw()->find(['followers.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('followed')->where(['followers.id'=>$user_id])->update(['followers.$.photo'=>$photo]);
            }   
        }
    }

    public static function updateUserFullname($user_id, $fullname){
        /** Update user media **/
        $datas = \App\Models\Media::raw()->find(['user.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('medias')->where('_id', $data['_id'])->update(['user.fullname'=>$fullname]);
            }   
        }

        /** Update user comments **/
        $datas = \App\Models\Comment::raw()->find(['user.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('comments')->where('_id', $data['_id'])->update(['user.fullname'=>$fullname]);
            }   
        }

        /** Update sender notification **/
        $datas = \App\Models\Notification::raw()->find(['sender.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('notifications')->where('_id', $data['_id'])->update(['sender.fullname'=>$fullname]);
            }   
        }

        /** Update receiver notification **/
        $datas = \App\Models\Notification::raw()->find(['receiver.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('notifications')->where('_id', $data['_id'])->update(['receiver.fullname'=>$fullname]);
            }   
        }

        /** Update user media popular **/
        $datas = \App\Models\MediaPopular::raw()->find(['user.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('media_popular')->where('_id', $data['_id'])->update(['user.fullname'=>$fullname]);
            }   
        }

        /** Update user following **/
        $datas = \App\Models\Following::raw()->find(['followings.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('following')->where(['followings.id'=>$user_id])->update(['followings.$.fullname'=>$fullname]);
            }   
        }

        /** Update user followed **/
        $datas = \App\Models\Followed::raw()->find(['followers.id'=>$user_id]);

        if($datas){
            foreach ($datas as $data) {
                \DB::collection('followed')->where(['followers.id'=>$user_id])->update(['followers.$.fullname'=>$fullname]);
            }   
        }
    }

    public static function isFollower($user_id){
        $current_user = User::current();

        if(!$current_user){
            return false;
        }

        $current_user_id = $current_user['_id'];
        $user_id = new ObjectID($user_id);

        $followed = \App\Models\Following::raw()->findOne(['user_id'=>$current_user_id, 'followings.id'=>$user_id]);

        return $followed ? true : false;
    }

    public static function getFollowing($timeline = false, $userId = null){
        $user = User::current();
        $user_id = $userId ? new ObjectId($userId) : $user['_id'];

        $following = \App\Models\Following::where('user_id', $user_id)->first();
        if(isset($following)){
            if(isset($userId)){
                $followings = array_map(function($v){ return $v; }, (array) $following->followings);
            }else{
                $followings = array_map(function($v){ return $v['id']; }, (array) $following->followings);
            }
        }else{
            $followings = [];
        }

        if($timeline){
            array_push($followings, $user_id);
        }

        return $followings;
    }

    public static function getFollower($userId){
        $user = User::current();
        $user_id = $userId ? new ObjectID($userId) : $user['_id'];

        $followed = \App\Models\Followed::where('user_id', $user_id)->first();
        if(isset($followed)){
            $followers = array_map(function($v){ return $v; }, (array) $followed->followers);
        }else{
            $followers = [];
        }

        return $followers;
    }

    public static function followerCount($user_id){
        $follower = \App\Models\Followed::where('user_id', $user_id)->first();

        if($follower){
            return count($follower['followers']);
        }

        return 0;
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

    public function getMediaCount($user_id = null){
        if(!isset($user_id)){
            $user_id = new ObjectID($this->_id);
        }

        $media = \App\Models\Media::where('user.id', $user_id)->count();

        return $media ? $media : 0;
    }

    public static function updateView($user_id){
        $user = User::where(['_id'=>$user_id])->first();
        if($user){
            $user->view_count += 1;
            $user->save();
        }
    }
}
