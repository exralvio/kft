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
        $followings = User::getFollowing(false);
        
        if(count($followings) == 0){
            $popularMedias = Media::where('user.id','!=',$user['_id'])->get()->sortBy('view_count', null, true);
        }else{
            $popularMedias = [];
        }

        array_push($followings, $user['_id']);
        
        $medias = Media::orderBy('_id','desc')
        ->whereIn('user.id', $followings)
        ->limit(3)
        ->get();


        foreach($medias as $key=>$media){
            if(in_array($user['_id'], array_map(function($v){ return $v['user_id']; }, $media->like_users))){
                $medias[$key]['liked'] = true;
            }else{
                $medias[$key]['liked'] = false;
            }
        }
        

        return view('dashboard/index',["posts"=>$medias, 'popularMedias'=>$popularMedias]);
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
    public function loadMedia($mediaId){
        $user = User::current();
        
        $comments = Comment::where('photo_id','=',$mediaId)->get();
        $media = Media::find($mediaId);

        if($media){
            $media->updateView();
        }

        if(in_array($user['_id'], array_map(function($v){ return $v['user_id']; }, $media->like_users))){
            $media['liked'] = true;
        }else{
            $media['liked'] = false;
        }

        return view('dashboard/comment', ["post"=>$media, "comments"=>$comments])->render();
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

            $notification = [
                "sender"=>[
                    "id"=>$currentUser['_id'],
                    "firstname"=>$currentUser['firstname'],
                    "lastname"=>$currentUser['lastname'],
                    "photo"=>$currentUser['photo'],
                ],
                "receiver"=>$media->user['id'],
                "type"=>"comment",
                "media"=>[
                    "id"=> $media->_id,
                    "title"=> $media->title,
                ]
                // "content"=>'<b>'.$currentUser['firstname']." ".$currentUser['lastname'].'</b> commented on <b>'.$media->title.'</b>'
            ];
            \NotificationHelper::setNotification($notification);

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

            $notification = [
                "sender"=>[
                    "id"=>$user['_id'],
                    "firstname"=>$user['firstname'],
                    "lastname"=>$user['lastname'],
                    "photo"=>$user['photo'],
                ],
                "receiver"=>$media->user['id'],
                "type"=>"like",
                "media"=>[
                    "id"=> $media->_id,
                    "title"=> $media->title,
                ]
                // "content"=>'<b>'.$user['firstname']." ".$user['lastname'].'</b> liked <b>'.$media->title.'</b>'
            ];
            \NotificationHelper::setNotification($notification);

            $updatedMedia = Media::find($request->post_id);
            return Response::json(['status'=>'liked', 'like_count'=>count($updatedMedia->like_users)],200);
        }
    }

}