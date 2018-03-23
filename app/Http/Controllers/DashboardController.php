<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Comment;
use App\Models\Following;
use Illuminate\Http\Request;
use Response;
use Session;
use App\Models\User;
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

    public function postComment(Request $request){
        $currentUser = User::current();
        // dd($currentUser);
        $media = Media::find($request->get('post_id'));
        // dd($media->id);
        $comment = new Comment;
        $comment->photo_id = new ObjectId($media->_id);
        $comment->user_id = $media->user_id;
        $comment->user_detail = [
            'first_name'=>$currentUser['firstname'],
            'last_name'=>$currentUser['lastname'],
            'photo'=>$currentUser['photo']
        ];
        $comment->comment = $request->get('comment');
        if($comment->save()){
            // return Response::json(['success' => true, 'data' => $comment->toArray()], 200);
            $html = view('dashboard/single-comment',["comment"=>$comment])->render();
            echo $html;
        }
    }

    public function deleteComment(Request $request){
        $comment = new Comment;
        $comment->delete();
        return Response::json(['status'=>'success'],200);
    }

}