<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class SisterCompany extends Eloquent
{
    protected $collection = 'sister_companies';

    public static function dropdown(){
    	$departments = SisterCompany::all()->toArray();
    	$results = array_map(function($arr){
    		return ['id'=> $arr['_id'], 'name'=> $arr['name']];
    	}, $departments);
    	
    	return array_column($results, 'name', 'id');
    }
}
