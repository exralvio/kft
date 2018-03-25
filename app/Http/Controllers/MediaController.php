<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use File;
use Response;
use App\Models\Media;
use App\Models\MediaCategory;
use Intervention\Image\ImageManagerStatic as Image;
use MongoDB\BSON\ObjectID;

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
        $directory = 'upload_tmp';
        // $directory = path('public').'uploads/tmp/'.sha1(time());
        $filename = sha1(time().time().rand()).".{$extension}";

        $upload_success = $request->file->storeAs($directory, $filename);

        $response = [
        	'filename'=>$filename,
            'upload_index'=>(int) $request->get('upload_index')
        ];

        if( $upload_success ) {
        	$response['status'] = 'success';
        	return Response::json($response, 200);
        } else {
        	$response['status'] = 'error';
        	return Response::json($response, 400);
        }
	}

    public function postConfirmUpload(Request $request){
        $items = $request->items;

        $errors = [];
        foreach ($items as $value) {
            $old_path = storage_path('upload_tmp/'.$value['filename']);
            if(file_exists($old_path)){
                $this->parseExif($value);
                
                $this->saveFile($value);

                $results = Media::saveUpload($value);
            }
        }

        return Response::json(['status'=>'success'], 200);
    }

    public function postUpdateMedia(Request $request){
        $media_id = $request->media_id;

        $media = Media::find($media_id);

        $category_id = $request->category;

        if(!empty($category_id)){
            $category = MediaCategory::raw()->findOne(['_id'=>new ObjectID($category_id)]);
            $media->category = ['id'=>(string) $category['_id'], 'name'=>$category['name']];
        } else {
            $media->category = ['id'=>'', 'name'=>'Uncategorized'];
        }

        $media->title = $request->title;
        $media->description = $request->description;
        $media->keywords = explode(",", $request->keywords);

        $exif = array(
            'camera' => $request->exif['camera'],
            'lens' => $request->exif['lens'],
            'focal_length' => $request->exif['focal_length'],
            'shutter_speed' => $request->exif['shutter_speed'],
            'aperture' => $request->exif['aperture'],
            'iso' => $request->exif['iso'],
            'date_taken' => $request->exif['date_taken']
        );

        $media->exif = $exif;

        $media->save();

        $results = [
            'status'=>'success',
            'data'=>$media
        ];

        return Response::json($results);
    }

    public function saveFile(&$input){
        $basename = pathinfo($input['filename'], PATHINFO_FILENAME);
        $extension = File::extension($input['filename']);

        $old_path = storage_path('upload_tmp/'.$input['filename']);

        $ori_name = 'uploads/original/'.$input['filename'];
        $md_name = 'uploads/medias/'.$basename.'-md.'.$extension;
        $lg_name = 'uploads/medias/'.$basename.'-lg.'.$extension;

        $ori_path = public_path($ori_name);
        $md_path = public_path($md_name);
        $lg_path = public_path($lg_name);

        if(!File::move($old_path, $ori_path)){
            return Response::json(['status'=>'error','message'=>'Unable to process the file.'], 200);
        }

        $md = Image::make($ori_path);
        $md->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio();
        });
        if($md->save($md_path)){
            // echo 'success';
        }

        $lg = Image::make($ori_path);
        $lg->resize(1250, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        if($lg->save($lg_path)){
            // echo 'success';
        }

        $input['images'] = [
            'original'=>$ori_name,
            'medium'=>$md_name,
            'large'=>$lg_name
        ];
    }

    public function parseExif(&$input){
        $old_path = storage_path('upload_tmp/'.$input['filename']);
        $exif = exif_read_data($old_path, 0, true);

        if(!isset($exif['IFD0'])){
            return;
        }

        $results = [];

        if(isset($exif['IFD0']['Model'])){
            $camera = $exif['IFD0']['Model'];
            $results['camera'] = $camera;
        }

        if(isset($exif['EXIF']['UndefinedTag:0xA434'])){
            $lens = $exif['EXIF']['UndefinedTag:0xA434'];
            $results['lens'] = $lens;
        }

        if(isset($exif['EXIF']['FocalLength'])){
            $focal_length = $exif['EXIF']['FocalLength'];
            $results['focal_length'] = $focal_length;
        }
        
        if(isset($exif['EXIF']['ExposureTime'])){
            $shutter_speed = $exif['EXIF']['ExposureTime'];
            $results['shutter_speed'] = $shutter_speed;
        }

        if(isset($exif['COMPUTED']['ApertureFNumber'])){
            $aperture = $exif['COMPUTED']['ApertureFNumber'];
            $results['aperture'] = $aperture;
        }
        
        if(isset($exif['EXIF']['ISOSpeedRatings'])){
            $iso = $exif['EXIF']['ISOSpeedRatings'];
            $results['iso'] = $iso;
        }

        if(isset($exif['EXIF']['DateTimeOriginal'])){
            $date_taken = $exif['EXIF']['DateTimeOriginal'];
            $results['date_taken'] = $date_taken;
        }
        
        $input['exif'] = $results;
    }

    public function getManage(){
        return view('media/manage');
    }
}