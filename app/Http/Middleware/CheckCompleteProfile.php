<?php

namespace App\Http\Middleware;

use Closure;
use \App\Models\User;
use MongoDB\BSON\ObjectID;

class CheckCompleteProfile
{

    public function handle($request, Closure $next)
    {   
        if (!$request->session()->exists('user')) {
            //if auth check is true, but session not found then logout user
            if(\Auth::check()){
                \Auth::logout();
            }
            // user value cannot be found in session
            return redirect('/');
        }else{
            $user_arr = $request->session()->get('user');
            // $user_arr = iterator_to_array($user_session);

            $user = User::raw()->findOne(['_id' => new ObjectId($user_arr['_id'])]);

            if($user['is_active'] == true && !empty($user['firstname']) && !empty($user['department'])){
                return $next($request);
            }else{
                \Session::flash('error', 'Please complete your profile before go to other page!');

                return redirect('/user/edit');
            }
        }
    }

}
