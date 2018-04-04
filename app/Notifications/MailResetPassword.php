<?php
 
namespace App\Notifications;
 
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Mail;

class MailResetPassword extends Notification
{
    use Queueable;
 
    public $token;
 
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }
 
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
 
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Password Reset Request")
                    ->action('Reset Password', url('password/reset', $this->token));
    }

    private $mail;
    public function resetPasswordMail($mail)
    {
        $this->mail['to'] = 'fazrin.mutaqin@gmail.com'; //$user['email'];
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
 
}