<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Comment;
use App\Models\Following;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;
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
        
        if(!$followings){
            $popularMedias =  Media::discoverPopular();
        }else{
            $popularMedias = [];
        }
        
        array_push($followings, $user['_id']);
        
        $posts = Media::orderBy('_id','desc')
        ->whereIn('user.id', $followings)
        ->limit(3)
        ->get();

        $current_user_id = $user['_id'];

        return view('dashboard/index', compact('current_user_id', 'posts', 'popularMedias'));
    }

    /**
     * function for ajax rendering
    */
    public function loadMoreMedia($mediaId){
        $user = User::current();
        $followings = User::getFollowing(true);

        $posts = Media::orderBy('_id','desc')
                ->where('_id','<',$mediaId)
                ->whereIn('user.id',$followings,'and')
                ->take(3)
                ->get();

        $current_user_id = $user['_id'];

        return view('dashboard/each-post', compact('current_user_id', 'posts'))->render();
    }

    /**
     * function for ajax rendering
    */
    public function loadMedia($mediaId){
        $user = User::current();

        $getComments = Comment::where('photo_id','=',new ObjectId($mediaId))->orderBy('_id')->get();
        $sortedComment = $this->sortByHierarcy($getComments->toArray());
        $comments = collect($sortedComment);

        $post = Media::find($mediaId);

        if(!$post){
            return abort(404);
        }

        if($post){
            $post->updateView();
        }

        $current_user_id = $user['_id'];

        return view('media/single', compact('current_user_id', 'post', 'comments'))->render();
    }

    /**
     * sort array of comment by hierarcy
    */
    private function sortByHierarcy($comments){
        usort($comments, function($a, $b){
            
            if(!isset($a['parent_comment'])) $a['parent_comment'] = '';
            if(!isset($b['parent_comment'])) $b['parent_comment'] = '';

            if ( $a['_id'] == $b['_id'] ) {
                return 0;
            
            } else if ( $a['parent_comment'] ) {
                if ( $a['parent_comment'] == $b['parent_comment'] ) {
                    return ( $a['_id'] < $b['_id'] ? -1 : 1 );
                } else {
                return ( $a['parent_comment'] >= $b['_id'] ? 1 : -1 );
                }
            } else if ( $b['parent_comment'] ) {
                return ( $b['parent_comment'] >= $a['_id'] ? -1 : 1);
            } else {
                return ( $a['_id'] < $b['_id'] ? -1 : 1 );
            }
        });

        return $comments;
    }

    public function postComment(Request $request){
        $currentUser = User::current();
       
        $media = Media::find($request->get('post_id'));

        if(!$media){
            return abort(400);
        }
        
        $comment = new Comment;
        $comment->photo_id = new ObjectId($media->_id);
        $comment->user = [
            'id' => $currentUser['_id'],
            'fullname'=>$currentUser['fullname'],
            'photo'=>$currentUser['photo']
        ];
        $comment->comment = $request->get('comment');
        $comment->parent_comment = null;
        if($request->get('parent_comment')){
            $comment->parent_comment = new ObjectId($request->get('parent_comment'));
        }

        if($comment->save()){
            $comment->updateMedia('add');

            if($currentUser['_id'] != $media->user['id']){
              \NotificationHelper::setNotification('comment', $currentUser['_id'], $media->user['id'],
                    [
                        "id"=> $media->_id,
                        "title"=> $media->title,
                    ]
                );  
            }
            
            $current_user_id = $currentUser['_id'];

            return view('partials/single-comment', compact('current_user_id', 'comment'))->render();
        }
    }

    public function deleteComment(Request $request){
        $comment = Comment::find($request->comment_id);
        $comment->updateMedia('remove');
        $comment->delete();

        return Response::json(['status'=>'success'],200);
    }

    public function likePost(Request $request){
        $rules = array(
            'post_id' => 'required',
            'action' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return Response::json([
                'status'=>'error',
                'message'=>$validator->errors()->first()
            ]);
        }

        $action = $request->action;
        $media = Media::find($request->post_id);

        $user_id = User::current()['_id'];

        if($media->user['id'] == $user_id){
            return Response::json([
                'status'=>'error',
                'message'=>"You're not allowed to like own post!"
            ]);
        }
        
        if($media->updateLike($action)){
            if($action == 'like'){
                return Response::json([
                    'status'=>'liked', 
                    'like_count'=>$media->like_count
                ]);
            } elseif($action == 'unlike'){
                return Response::json([
                    'status'=>'unliked', 
                    'like_count'=>$media->like_count
                ]);
            }
        }

        return Response::json([
            'status'=>'error', 
            'message'=>'Unexpected error.'
        ]);
    }

}