<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Comment;
use App\Models\Following;
use Session;
use MongoDB\BSON\ObjectID;

class DashboardController extends Controller{

    public function __construct(){
    }
    
    private function getAllFollowing(){
        $currentUserId = Session::get('user')->_id->__toString();
        $following = Following::where('user_id','=',$currentUserId)->first();
        return $following;
    }

    public function showDashboard(){
        $currentUserId = Session::get('user')->_id;
        $following = $this->getAllFollowing();
        if(isset($following)){
            $followed_ids = $following->followed_ids;
        }else{
            $followed_ids = [];
        }
        array_push($followed_ids, $currentUserId);

        $medias = Media::orderBy('_id','desc')
                ->whereIn('user_id',$followed_ids)
                ->limit(3)
                ->get();

        return view('dashboard/index',["posts"=>$medias]);
    }

    /**
     * function for ajax rendering
    */
    public function loadMoreMedia($mediaId){
        $currentUserId = Session::get('user')->_id;
        $following = $this->getAllFollowing();
        if(isset($following)){
            $followed_ids = $following->followed_ids;
        }else{
            $followed_ids = [];
        }

        array_push($followed_ids, $currentUserId);
        $medias = Media::orderBy('_id','desc')
                ->where('_id','<',$mediaId)
                ->whereIn('user_id',$followed_ids,'and')
                ->take(2)
                ->get();

        $html = view('dashboard/single-post',["posts"=>$medias])->render();
        echo $html;
    }

    /**
     * function for ajax rendering
    */
    public function loadCommentPage($mediaId){
        $mediaId = new ObjectId($mediaId);
        // $comments = Comment::raw()->findOne(['photo_id'=>$mediaId]);
        $comments = Comment::where('photo_id','=',$mediaId)->get();
        $media = Media::find($mediaId);
        // dd($media);
        $html = view('dashboard/comment',["post"=>$media, "comments"=>$comments])->render();

        echo $html;
    }

}