<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

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
        return view('auth/passwords/reset-password', ['token'=>$token]);
    }

    public function saveResetPassword(Request $request){
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        if($user){
            $tokenValid = \Password::getRepository()->exists($user, $data['reset_token']);
            if($tokenValid){
                if($data['password'] == $data['confirm_password']){
                    $user->password = bcrypt($data['password']);
                    if($user->save()){
                        $request->session()->flash('password_changed', 'Password has been succesfully changed. Please Login to continue');
                        return redirect('reset-password/'.$data['reset_token']);
                    }
                }else{
                    return Redirect::to('reset-password/'.$data['reset_token'])
                    ->withErrors(['confirmation_do_not_match'=>'Password and Confirmation do not match']);
                }
            }else{
                $request->session()->flash('token_invalid', 'Your token is invalid or has been expired');
                return redirect('reset-password/'.$data['reset_token']);
            }
        }else{
            return abort(400);
        }
    }
}
