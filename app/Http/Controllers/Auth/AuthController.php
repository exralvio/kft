<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Mail;

use Session;
use Validator;
use Auth;

class AuthController extends Controller{

    public function __construct() {
        if (Auth::check()){
            return redirect()->to('/dashboard');
        }
    }

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
            
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {
                $loginUser = Auth::User();
                Session::put('email',$loginUser->email);
                return redirect()->intended('dashboard');
            } else {        
                return Redirect::to('login')
                    ->withErrors(['failedLogin'=>'Email or Password was incorrect'])
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
            $findUser = User::raw()->findOne(Array('email'=>$request->get('email')));
            if($findUser){
                return Redirect::to('signup')
                    ->withInput(Input::except('password'))
                    ->withErrors(['email'=>'Email Already Registered']);
            }else{
                $newUser = new User();
                $newUser->email = $request->get('email');
                $newUser->password = Hash::make($request->get('email'));
                $newUser->save();
                // $this->sendSignUpMail($newUser->email);
                // return Redirect::to('sendMail');
                dd('Email send to '.$newUser->email);
            }

        }
    }

    public function doLogout(){
        \Auth::logout();
        return Redirect::to('login');
    }

    public function sendSignUpMail($to = 'fazrin.mutaqin@gmail.com', $data = [])
    {
        $subject = 'Registration Notification';
        Mail::send('emails.signup-mail', $data, function($message)
        {
            $message->subject('');
            $message->to($to);
        });
    }
}