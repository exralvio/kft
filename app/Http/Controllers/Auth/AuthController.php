<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{

    public function showIndex(){
        return view('landing/index');
    }

    public function showLogin(){
        return view('landing/login');
    }

    private $authRules = array(
        'email' => 'required|email',
        'password' => 'required|alphaNum|min:3'
    );

    public function doLogin(Request $request){

        $validator = Validator::make($request->all(), $this->authRules);

        if($validator->fails()){
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }else{
            $findUser = \Mongo::get()->kft_db->users->findOne(Array('email'=>$request->get('email')));
            if($findUser && Hash::check($request->get('password'), $findUser->password)){
                echo "Should set session and change Login, Signup to profile's username";
            }else{
                return Redirect::to('login')
                    ->withErrors(['password'=>'Email or Password Wrong'])
                    ->withInput(Input::except('password'));
            }
        }
    }

    public function showSignup(){
        return view('landing/signup');
    }

    public function doSignup(Request $request){
        
        $validator = Validator::make($request->all(), $this->authRules);
        if($validator->fails()){
            return Redirect::to('signup')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }else{

            $userdata = array(
                'email' 	=> $request->get('email'),
                'password' 	=> Hash::make($request->get('password'))
            );
            /**
             * check if username already exists
            */
            $findUser = \Mongo::get()->kft_db->users->findOne(Array('username'=>'fazrin.mutaqin@wgs.co.id'));
            if($findUser){
                return Redirect::to('signup')
                    ->withInput(Input::except('password'))
                    ->withErrors(['email'=>'Email Already Registered']);
            }else{
                \Mongo::get()->kft_db->users->insertOne($userdata);
                /**
                 * then it should be redirect to user profile to complete user data
                */
            }

        }
    }

    public function sendEmailSignupNotification(){
        
    }

}