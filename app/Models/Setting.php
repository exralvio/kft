<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Setting extends Eloquent
{
    protected $collection = 'settings';

    protected $fillable = ['label', 'value'];

    public static function valueOf($label){
    	$setting = Setting::raw()->findOne(['label'=>$label]);

    	return $setting ? $setting['value'] : 0;
    }
}
