<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;

class UserController extends Controller{

    public function showProfile(){
        return view('user/profile');
    }

}