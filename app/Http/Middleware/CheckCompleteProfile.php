<?php

namespace App\Http\Middleware;

use Closure;

class CheckCompleteProfile
{

    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('user')) {
            // user value cannot be found in session
            return redirect('/');
        }else{
            $user_session = $request->session()->get('user');
            $user = iterator_to_array($user_session);
            if(isset($user['firstname']) && isset($user['department'])){
                return $next($request);
            }else{
                //redirect to edit profile
                return redirect('/user/profile#editProfile');
            }
        }
    }

}
