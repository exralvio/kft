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
use Carbon\Carbon;

class DashboardController extends Controller{

    public function __construct(){
    }

    /**
     * if following == 0
     * then 
     * get popular post
     * else
     * show following 
    */
    public function showDashboard(){
        $user = User::current();
        $followings = User::getFollowing(true);

        // if(count($followings)>0){
        $medias = Media::orderBy('_id','desc')
                ->whereIn('user.id', $followings)
                ->limit(3)
                ->get();
        // }else{
        //     $medias = Media::orderBy('_id','desc')
        //             ->orderBy('view_count', 'desc')
        //             ->limit(3)
        //             ->get();
        // }
        
        foreach($medias as $key=>$media){
            if(in_array($user['_id'], array_map(function($v){ return $v['user_id']; }, $media->like_users))){
                $medias[$key]['liked'] = true;
            }else{
                $medias[$key]['liked'] = false;
            }
        }
        

        return view('dashboard/index',["posts"=>$medias]);
    }

    /**
     * function for ajax rendering
    */
    public function loadMoreMedia($mediaId){
        $user = User::current();
        $followings = User::getFollowing(true);

        $medias = Media::orderBy('_id','desc')
                ->where('_id','<',$mediaId)
                ->whereIn('user.id',$followings,'and')
                ->take(3)
                ->get();

        foreach($medias as $key=>$media){
            if(in_array($user['_id'], array_map(function($v){ return $v['user_id']; }, $media->like_users))){
                $medias[$key]['liked'] = true;
            }else{
                $medias[$key]['liked'] = false;
            }
        }

        $html = view('dashboard/single-post',["posts"=>$medias])->render();
        echo $html;
    }

    /**
     * function for ajax rendering
    */
    public function loadCommentPage($mediaId){
        $user = User::current();
        $mediaId = new ObjectId($mediaId);
        // $comments = Comment::raw()->findOne(['photo_id'=>$mediaId]);
        $comments = Comment::where('photo_id','=',$mediaId)->get();
        $media = Media::find($mediaId);

        if(in_array($user['_id'], array_map(function($v){ return $v['user_id']; }, $media->like_users))){
            $media['liked'] = true;
        }else{
            $media['liked'] = false;
        }

        $html = view('dashboard/comment',["post"=>$media, "comments"=>$comments])->render();

        echo $html;
    }

    public function postComment(Request $request){
        $currentUser = User::current();
        // dd($currentUser);
        $media = Media::find($request->get('post_id'));
        // dd($media);
        $comment = new Comment;
        $comment->photo_id = new ObjectId($media->_id);
        $comment->user = [
            'id' => $media->user['id'],
            'firstname'=>$currentUser['firstname'],
            'lastname'=>$currentUser['lastname'],
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
        Comment::destroy($request->comment_id);
        return Response::json(['status'=>'success'],200);
    }

    public function likePost(Request $request){

        $user = User::current();
        $media = Media::find($request->post_id);
        if(in_array($user['_id'], array_map(function($v){ return $v['user_id']; }, $media->like_users))){
            $media->pull('like_users',Array("user_id"=> $user['_id']));
            $updatedMedia = Media::find($request->post_id);
            return Response::json(['status'=>'unliked', 'like_count'=>count($updatedMedia->like_users)],200);
        }else{
            $media->push('like_users',Array(
                "user_id"=> $user['_id'],
                "firstname"=> $user['firstname'],
                "lastname"=> $user['lastname'],
                "created_at"=> Carbon::now()->toDateTimeString()
            ));
            $updatedMedia = Media::find($request->post_id);
            return Response::json(['status'=>'liked', 'like_count'=>count($updatedMedia->like_users)],200);
        }
    }

}