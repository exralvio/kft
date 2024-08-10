<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserDepartment extends Eloquent
{
    protected $collection = 'user_departments';

    public static function dropdown(){
    	$departments = UserDepartment::all()->toArray();
    	$results = array_map(function($arr){
    		return ['id'=> $arr['_id'], 'name'=>$arr['parent'].' - '.$arr['name']];
    	}, $departments);
    	
    	return array_column($results, 'name', 'id');
    }
}
