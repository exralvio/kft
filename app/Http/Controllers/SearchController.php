<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use MongoDB\BSON\ObjectID;
use App\Models\User;

class SearchController extends Controller{

        public function showSearchResult(Request $request){

            $user = User::current();
            $current_user_id = $user['_id'];
            // return view('media/discover', compact('current_user_id'));

            // dd($request->get('q'));
            if($request->get('type') == 'photos'){
                $medias = Media::where('title','like',"%{$request->get('q')}%")
                        ->orWhere('description','like',"%{$request->get('q')}%")
                        ->get();
                return view('search/index',['medias'=>$medias, 'type'=>"photos", 'current_user_id'=>$current_user_id]);
            }else if($request->get('type') == 'users'){
                $users = User::where("fullname",'like',"%{$request->get('q')}%")->get();
                return view('search/index',['data'=>$users, 'type'=>"users"]);
            }
            return view('search/index',['medias'=>[], 'current_user_id'=>$current_user_id]);
        }

}