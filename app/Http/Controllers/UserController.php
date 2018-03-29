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

class UserController extends Controller{

    public function showProfile(Request $request){
        $user_session = $request->session()->get('user');
        $user_data = iterator_to_array($user_session);
        $user = User::where('email', $user_data['email'])->first();
        $user_media = $this->getUploadedMedia();
        /**
         * Get Department master
        */
        $departments = UserDepartment::get();

        return view('user/profile',['user'=>$user,'departments'=>$departments,'medias'=>$user_media]);
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
            $collection = collect($request->all() + ['is_active'=>true]);
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

        if($file->move($path, $filename)){
            return $filepath.'/'.$filename;
        } else {
            return null;
        }
    }

}