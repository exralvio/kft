<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use MongoDB\BSON\ObjectID;

class SearchController extends Controller{

        public function showSearchResult(Request $request){
            // dd($request->get('q'));
            if($request->get('type') == 'photos'){
                $medias = Media::where('title','like',"%{$request->get('q')}%")
                        ->orWhere('description','like',"%{$request->get('q')}%")
                        ->get();
                return view('search/index',['data'=>$medias]);
            }
        }

}