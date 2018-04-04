<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Contracts\Auth\PasswordBroker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Session;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRecoverPasswordForm(){
        return view('auth/passwords/reset-password');
    }

    private $mail;
    public function sentResetPasswordMail(Request $request){

        $email = $request->get('email');

        $user = User::where('email', $email)->first();
        if ($user) {
            //so we can have dependency 
            $password_broker = app(PasswordBroker::class);
            //create reset password token 
            $token = $password_broker->createToken($user); 
            \DB::collection('password_resets')->insert(['email' => $user->email, 'token' => $token, 'created_at' => new Carbon]);

            $this->mail = Array(
                'to'=>$email,
                'subject'=>'Reset Password Request',
                'reset_token'=>$token
            );

            $this->sendResetMail();
        }else{
            $request->session()->flash('email_not_registered', 'Email Not Registered on KFT');
            return redirect('recover-password');
        }
    }

    public function sendResetMail()
    {   
        $this->mail['to'] = $this->mail['to'];
        $this->mail['subject'] = $this->mail['subject'];
        Mail::send('emails.recover-password-mail', ['token' => $this->mail['reset_token']], function($message)
        {
            $message->subject($this->mail['subject']);
            $message->to($this->mail['to']);
        });
        
        if(Mail::failures()){
            Session::flash('email_failed_to_send', 'Email failed to send, please try again later.');
            return redirect('recover-password');
        }else{
            Session::flash('reset_email_sent', 'Reset Password Link has been sent to your email');
            return redirect('recover-password');
        }
    }

}
