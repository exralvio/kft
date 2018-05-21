<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MediaFresh;
use App\Models\MediaPopular;

class LandingController extends Controller{

    public function showIndex(){
    	if(\Auth::check()){
    		return redirect('/dashboard');
    	}

    	$media_fresh = MediaFresh::orderBy('_id','desc')
                ->take(10)
                ->get();


        $media_popular = MediaPopular::orderBy('like_count', 'desc')
                        ->where('popular_threshold', '>=', now()->format('Y-m-d H:i:s'))
                        ->take(10)
                        ->get();

       	$current_user_id = false;

        return view('landing/index', compact('media_fresh','media_popular','current_user_id'));
    }

}