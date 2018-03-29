<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use MongoDB\BSON\ObjectID;
use App\Models\User;

class SearchController extends Controller{

        public function showSearchResult(Request $request){
            // dd($request->get('q'));
            if($request->get('type') == 'photos'){
                $medias = Media::where('title','like',"%{$request->get('q')}%")
                        ->orWhere('description','like',"%{$request->get('q')}%")
                        ->get();
                return view('search/index',['data'=>$medias, 'type'=>"photos"]);
            }else if($request->get('type') == 'users'){
                $users = User::where("fullname",'like',"%{$request->get('q')}%")->get();
                return view('search/index',['data'=>$users, 'type'=>"users"]);
            }
            return view('search/index',['data'=>[]]);
        }

}