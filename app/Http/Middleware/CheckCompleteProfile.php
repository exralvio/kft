<?php

namespace App\Http\Middleware;

use Closure;
use \App\Models\User;

class CheckCompleteProfile
{

    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('user')) {
            // user value cannot be found in session
            return redirect('/');
        }else{
            $user_session = $request->session()->get('user');

            $isJson = json_decode($user_session, true);
            if (is_array($isJson)) {
                $user_arr = $isJson;
            } else {
                $user_arr = iterator_to_array($user_session);
            }

            $user = User::raw()->findOne(['_id' => $user_arr['_id']]);

            if($user['is_active'] == true){
                return $next($request);
            }else{
                \Session::flash('error', 'Please complete your profile before go to other page!');

                return redirect('/user/edit');
            }
        }
    }

}
