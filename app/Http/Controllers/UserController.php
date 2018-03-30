<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use App\Models\UserDepartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Response;
use File;
use MongoDB\BSON\ObjectID;
use Intervention\Image\ImageManagerStatic as Image;
use \App\Models\Following;
use \App\Models\Followed;

class UserController extends Controller{

    public function showProfile(Request $request){
        $user_session = $request->session()->get('user');
        $user_data = iterator_to_array($user_session);
        $user = User::where('email', $user_data['email'])->first();
        $medias = $this->getUploadedMedia();

        return view('user/profile', compact('user','medias'));
    }

    private function getUploadedMedia(){
        $medias = Media::where('user.id',User::current()['_id'])->get();
        return $medias;
    }

    public function saveEditProfile(Request $request){

        $profileRules = array(
            'firstname' => 'required',
            'department' => 'required'
        );

        $validator = Validator::make($request->all(), $profileRules);

        if($validator->fails()){
            return Redirect::to('user/profile#editProfile')
                    ->withErrors($validator);
        }else{
            $department = \App\Models\UserDepartment::find($request->department);
            $input_department = [
                'id'=>new ObjectID($department['_id']),
                'name'=>$department['parent'].' '.$department['name']
            ];

            $request->merge([
                'is_active'=>true, 
                'department'=>$input_department,
                'fullname'=>!empty($request->lastname) ? $request->firstname.' '.$request->lastname : $request->firstname
            ]);
            
            $collection = collect($request->all());
            if($request->hasFile('photo')){
                $savedFilename = $this->uploadProfilePict($request);
                $collection->put('photo', $savedFilename);
            }

            $departments = UserDepartment::get();
            $user_session = $request->session()->get('user');
            $user_data = iterator_to_array($user_session);
            $user = \DB::collection('users')->where('email', $user_data['email'])->update($collection->all());
            $updatedUser = User::where('email', $user_data['email'])->first();

            return redirect('user/profile');
        }
    }

    private function uploadProfilePict($request){
        /**
         * Handle upload file
        */
        $file = $request->file('photo');

        /**
         * Move Uploaded File
         * Temporary destination 
         **/ 

        $original_name = $file->getClientOriginalName();
        $extension = File::extension($original_name);
        $filename = sha1(time().time().rand()).".{$extension}";
        $filepath = 'uploads/profile';
        $path = public_path($filepath);
        $originalpath = public_path($filepath.'/original');

        $originaldestination = $originalpath.'/'.$filename;
        $filedestination = $filepath.'/'.$filename;

        /** Save original file **/
        $file->move($originalpath, $filename);

        $img = Image::make($originaldestination);

        // resize the image to a width of 300 and constrain aspect ratio (auto height)
        $img->fit(150, 150);

        if($img->save($filedestination)){
            File::delete($originaldestination);

            \App\Models\User::updateUserPhoto(User::current()['_id'], $filedestination);

            return $filedestination;
        } else {
            return null;
        }
    }

    public function getProfile($user_id){
        $user = User::find($user_id);

        if(!$user){
            return abort(404);
        }

        $medias = Media::selfMedia($user['_id']);

        return view('user/profile', compact('user','medias'));
    }

    public function postRelation(Request $request){
        $profileRules = array(
            'action' => 'required',
            'user_id' => 'required'
        );

        $validator = Validator::make($request->all(), $profileRules);

        if($validator->fails()){
            return Response::json(['status'=>'error','errors'=>$validator->errors()->first()], 500);
        }

        if($request->action == 'follow'){
            return $this->doFollow($request->all());
        } else if($request->action = 'unfollow'){
            return $this->doUnfollow($request->all());
        }
    }

    public function doFollow($request){
        $me = User::current();
        $self_id = $me['_id'];
        $user_id = new ObjectID($request['user_id']);

        /** Check if already follow **/
        if(User::isFollower($user_id)){
            return Response::json([
                'status'=>'error',
                'errors'=>"You're already followed."
            ]);
        };

        /** Update following **/
        $following = Following::raw()->findOne(['user_id'=>$self_id]);

        $user = User::find($user_id);
        if($following){
            
            $following = Following::find($following['_id']);
            $following->push('followings', [
                'id'=>new ObjectID($user['_id']),
                'firstname'=>$user['firstname'],
                'lastname'=>$user['lastname'],
                'photo'=>$user['photo']
            ]);
        } else {
            $following = new Following;
            $following->user_id = $self_id;
            $following->followings = [[
                'id'=>new ObjectID($user['_id']),
                'firstname'=>$user['firstname'],
                'lastname'=>$user['lastname'],
                'photo'=>$user['photo']
            ]];
            
            if($following->save()){
                $notification = [
                    "sender"=>[
                        "id"=>$me['_id'],
                        "firstname"=>$me['firstname'],
                        "lastname"=>$me['lastname'],
                        "photo"=>$me['photo'],
                    ],
                    "receiver"=>$following->user_id,
                    "type"=>"follow",
                    "media"=>[]
                ];
                \NotificationHelper::setNotification($notification);
            }
        }

        /** Update followed **/
        $followed = Followed::raw()->findOne(['user_id'=>$user_id]);

        $user = User::find($self_id);
        if($followed){
            $followed = Followed::find($followed['_id']);
            $followed->push('followers', [
                'id'=>new ObjectID($user['_id']),
                'firstname'=>$user['firstname'],
                'lastname'=>$user['lastname'],
                'photo'=>$user['photo']
            ]);
        } else {
            $followed = new Followed;
            $followed->user_id = $user_id;
            $followed->followers = [[
                'id'=>new ObjectID($user['_id']),
                'firstname'=>$user['firstname'],
                'lastname'=>$user['lastname'],
                'photo'=>$user['photo']
            ]];

            $followed->save();
        }

        return Response::json([
            'status'=>'success',
            'message'=>"You're now following."
        ]);
    }

    public function doUnfollow($request){
        $self_id = User::current()['_id'];
        $user_id = new ObjectID($request['user_id']);

        /** Check if already follow **/
        if(!User::isFollower($user_id)){
            return Response::json([
                'status'=>'error',
                'errors'=>"You're not follower."
            ]);
        };

        /** Update following **/
        $following = Following::raw()->findOne(['user_id'=>$self_id]);

        $user = User::find($user_id);
        if($following){
            $following = Following::find($following['_id']);
            $following->pull('followings', ['id'=>new ObjectID($user['_id'])] );
        }

        /** Update followed **/
        $followed = Followed::raw()->findOne(['user_id'=>$user_id]);

        $user = User::find($self_id);
        if($followed){
            $followed = Followed::find($followed['_id']);
            $followed->pull('followers', ['id'=>new ObjectID($user['_id'])] );
        }

        return Response::json([
            'status'=>'success',
            'message'=>"You're now not follower."
        ]);
    }

}