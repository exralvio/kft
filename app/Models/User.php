<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

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

    public static function name($firstname, $lastname){
    	return empty($lastname) ? $firstname : $firstname.' '.$lastname;
    }
}
