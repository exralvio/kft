<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class LandingController extends Controller{

    public function showIndex(){
    	if(\Auth::check()){
    		return redirect('/dashboard');
    	}

        return view('landing/index');
    }

}