<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use File;
use Response;

class MediaController extends Controller{

    public function postUpload(Request $request){
		$input = $request->all();

		$rules = array(
		    'file' => 'image|max:50000',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			return Response::make($validation->errors()->first(), 400);
		}

		$original_name = $request->file('file')->getClientOriginalName();

        $extension = File::extension($original_name);
        $directory = 'tmp';
        // $directory = path('public').'uploads/tmp/'.sha1(time());
        $filename = sha1(time().time()).".{$extension}";

        $upload_success = $request->file->storeAs($directory, $filename);

        $response = [
        	'filename'=>$filename,
        	'original'=>$original_name
        ];

        if( $upload_success ) {
        	$response['status'] = 'success';
        	return Response::json($response, 200);
        } else {
        	$response['status'] = 'error';
        	return Response::json($response, 400);
        }
	}

}