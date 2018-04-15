<?php

namespace App\Http\Controllers;
use App\Models\Activation;
use App\Models\User;
use Session;

class ActivateController extends Controller
{

    public function activate($token)
    {
        $activation = Activation::where('token', $token)->first();
        if (empty($activation)) {
            Session::flash('activation_failed', 'Activation Failed! Token Not Found');
            return redirect('login');
        }

        $user = User::find($activation->user_id);
        $user->is_verified = true;
        $user->save();

        $activation->delete();
        Session::flash('activation_success', 'Your Account has been activated. Please Login and Complete your profile');
        return redirect('login');

    }

}