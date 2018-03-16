<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;

class DashboardController extends Controller{

    public function showDashboard(){
        $medias = Media::orderBy('created_at','desc')->get();
        return view('dashboard/index',["posts"=>$medias]);
    }

}