<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Activation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Services\SocialFacebookAccountService;
use MongoDB\BSON\ObjectID;

use Mail;
use Socialite;
use Session;
use Validator;
use Auth;

class AuthController extends Controller{

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        if($authUser && $authUser->is_verified == false){
            Session::flash('not_activated', "Your Account is Not Activated. Please Activate your account by clicking the link we have sent to your email. <a href='".url('resendActivation/'.$authUser->email)."'>Resend Email</a>");
            return redirect('login');
        }else if($authUser && $authUser->provider_exception == true){
            Session::flash('not_activated', "Login Failed");
            return redirect('login');
        }else{
            Auth::login($authUser, true);
            Session::put('user',$authUser->toArray());
            return redirect()->intended('dashboard');
        }
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        //find user by provider id
        $authUser = User::where("provider.".$provider."_id", $user->id)
                ->orWhere('email',$user->email)
                ->first();
        if ($authUser) {
            if($authUser->is_verified == false){
                return $authUser;
            }
            if(!isset($authUser->provider[$provider."_id"])){
                if(!empty($authUser->provider) && is_array($authUser->provider)){
                    // try{
                    $authUser->provider = array_merge($authUser->provider, [$provider."_id"=>$user->id]);
                    // } catch (Exception $e){
                    //     $authUser->provider_exception = true;
                    //     return $authUser;
                    // }
                } else {
                    $authUser->provider = [$provider."_id"=>$user->id];
                }
                $authUser->update();
            }
            return $authUser;
        }else{
            /**
             * if search by provider id not found
             * then
             * search by email then update the provider
            */
            $authUser = User::where("email", $user->email)->first();
            if($authUser){
                //if exist, have been login by different provider but different email address
                $authUser->provider = array_merge($authUser->provider, [$provider."_id"=>$user->id]);
                $authUser->update();
                return $authUser;
            }else{
                //totally new record on database
                $newUser = new User();
                $newUser->email = $user->email;
                $fullName = explode(" ",$user->name);
                $newUser->firstname = $fullName[0];
                $newUser->lastname = isset($fullName[1]) ? $fullName[1] : '';
                $newUser->fullname = $user->name;
                $newUser->is_active = false;
                $newUser->is_verified = true;
                $newUser->birthday = '';
                $newUser->gender = '';
                $newUser->company = '';
                $newUser->sister_company = '';
                $newUser->about = '';
                $newUser->photo = $user->avatar;
                $newUser->view_count = 0;
                // $newUser->provider = $provider;
                // $newUser->provider_id = $user->id;
                $newUser->provider = [$provider."_id" => $user->id];
                $newUser->department = [];
                if($newUser->save()){
                    return $newUser;
                }else{
                    dd('Signup failed');
                }
            }
            
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

    /**
     * another validation needed:
     * if user profile has not complete
     * then do not redirect to dashboard
     * redirect to user profile instead
    */
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

            /**
             * check wether the account is activated
            */
            $findUser = User::where('email',$request->get('email'))->first();
            if($findUser && $findUser->is_verified == false){
                Session::flash('not_activated', "Your Account is Not Activated. Please Activate your account by clicking the link we have sent to your email. <a href='".url('resendActivation/'.$findUser->email)."'>Resend Email</a>");
                return Redirect::to('login');
            }

            if (Auth::attempt($userdata)) {
                $loginUser = Auth::User();
                /**
                 * get users by email to store into session
                 * will be used by custom middleware later to check complete profile
                */
                // $findUser = User::raw()->findOne(Array('email'=>$request->get('email')));
                $findUser = User::where('email',$request->get('email'))->first();
                Session::put('user',$findUser->toArray());
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
                'password' 	=> bcrypt($request->get('password'))
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
                $newUser->password = bcrypt($request->get('password'));

                $newUser->firstname = '';
                $newUser->lastname = '';
                $newUser->fullname = '';
                $newUser->is_active = false;
                $newUser->is_verified = false;
                $newUser->birthday = '';
                $newUser->company = '';
                $newUser->sister_company = '';
                $newUser->gender = '';
                $newUser->about = '';
                $newUser->photo = '';
                $newUser->view_count = 0;
                $newUser->department = [];

                if($newUser->save()){
                    if($this->createTokenAndSendEmail($newUser)){
                        Session::flash('activation_email_sent', 'Activation email has been sent into your email');
                        return redirect('signup');
                    }
                }else{
                    dd('Signup failed');
                }
            }

        }
    }

    public function doLogout(Request $request){
        // $request->session()->forget('user');
        \Auth::logout();
        return redirect('/');
    }

    /**
     * will be moved into mail helper later
     * 'fazrin.mutaqin@gmail.com' hardcoded temporary so it should not send to registed email 
     * for dev purpose only
    */
    private $mail;
    public function sendSignUpMail($user = [], $subject, $redirectRoute = null)
    {
        $this->mail['to'] = $user['email'];
        $this->mail['subject'] = $subject;
        Mail::send('emails.signup-mail', ['user' => $user], function($message)
        {
            $message->subject($this->mail['subject']);
            $message->to($this->mail['to']);
        });
        
        if(Mail::failures()){
            //do something
            dd('Mail failed to send, set handler here');
        }else{
            return true;
        }
    }

    public function resendActivationMail($email){
        $user = User::where('email',$email)->first();
        if($user){
            if($this->createTokenAndSendEmail($user)){
                Session::flash('activation_email_sent', 'Activation email has been sent into your email');
                return redirect('login');
            }
        }else{
            Session::flash('not_activated', 'Email Not Registered');
            return redirect('login');
        }
    }

    public function createTokenAndSendEmail(User $user)
    { 
        // Create new Activation record for this user/email
        $activation = new Activation;
        $activation->user_id = new ObjectId($user->id);
        $activation->email = $user->email;
        $activation->token = str_random(64);
        $activation->save();

        // Send activation email notification
        if($this->sendActivationMail($activation)){
            return true;
        }else{
            return false;
        }
    }

    public function sendActivationMail($activation)
    {   
        $this->mail['to'] = $activation->email;
        $this->mail['subject'] = 'User Activation';
        $this->mail['token'] = $activation->token;
        Mail::send('emails.activation-mail', ['token' => $this->mail['token']], function($message)
        {
            $message->subject($this->mail['subject']);
            $message->to($this->mail['to']);
        });
        
        if(Mail::failures()){
            return false;
        }else{
            return true;
        }
    }

}