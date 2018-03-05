<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AuthController extends Controller{


    public function showIndex(){
        return view('landing/index');
    }

    public function showLogin(){
        return view('landing/login');
    }

    public function doLogin(Request $request){

		$rules = array(
			'username' => 'required|email',
			'password' => 'required|alphaNum|min:3'
        );
        
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }else{
            $userdata = array(
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password')
			);
            echo "Validation Success";
        }
    }

    public function showSignup(){
        return view('landing/signup');
    }

    public function doSignup(Request $request){
        $rules = array(
			'username' => 'required|email',
			'password' => 'required|alphaNum|min:3'
        );
        
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return Redirect::to('signup')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }else{
            $userdata = array(
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password')
			);
            echo "Validation Success, next step is complete user data";
        }
    }

}