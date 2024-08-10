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

            if(!$request->get('type') || !$request->get('q')){
                return abort(404);
            }

            if($request->get('type') == 'photos'){
                $datas = Media::where('title','like',"%{$request->get('q')}%")
                        ->orWhere('description','like',"%{$request->get('q')}%")
                        ->get();
            } else if($request->get('type') == 'users'){
                $datas = User::where("fullname",'like',"%{$request->get('q')}%")->get();
            }

            $type = $request->get('type');

            return view('search/index', compact('datas', 'type', 'current_user_id'));
        }

}