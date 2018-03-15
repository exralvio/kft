<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Response;

class UserController extends Controller{

    public function showProfile(Request $request){
        $user_session = $request->session()->get('user');
        $user_data = iterator_to_array($user_session);
        // $user = \DB::collection('users')->where('email', $user_data['email'])->first();
        $user = User::where('email', $user_data['email'])->first();
        /**
         * set temporary data just in case not exists on collection
         **/
        return view('user/profile',['user'=>$user]);
    }

    public function saveEditProfile(Request $request){

        $profileRules = array(
            'firstname' => 'required',
            'department' => 'required'
        );

        $validator = Validator::make($request->all(), $profileRules);

        if($validator->fails()){
            return Redirect::to('user/profile#editProfile')
                    ->withErrors($validator);
        }else{
            $user_session = $request->session()->get('user');
            $user_data = iterator_to_array($user_session);
            $user = \DB::collection('users')->where('email', $user_data['email'])->update($request->all());
            $updatedUser = User::where('email', $user_data['email'])->first();
            return view('user/profile',['user'=>$updatedUser]);
        }
    }

}