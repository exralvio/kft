<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetPasswordForm($token){
        $findToken = \DB::collection('password_resets')->where('token',$token)->first();
        $user = User::where('email', $findToken['email'])->first();
        if($user){
            $tokenValid = \Password::getRepository()->exists($user, $token);
            if($tokenValid){
                return view('errors/404');
            }else{
                return view('auth/passwords/reset-password', ['email'=>$user['email']]);
            }
        }else{
            // dd('user not found or token invalid');
            return view('auth/passwords/reset-password');
        }
    }

    public function saveResetPassword(Request $request){
        dd($request->all());
    }
}
