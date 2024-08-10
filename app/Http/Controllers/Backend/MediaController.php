<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;
use MongoDB\BSON\ObjectID;
use Session;
use Yajra\Datatables\Datatables;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $medias = Media::paginate(10);
        return view('admin.photo.index');
    }
    
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        $datas = Media::get();
        // dd($datas);
        return Datatables::of($datas)
            ->addColumn('action', function ($data) {
                return '<a href="'.url('admin/media').'/'.$data->_id.'/edit" class="btn btn-xs btn-primary">
                            <i class="glyphicon glyphicon-edit"></i> Edit
                        </a>
                        <a data-postId="'.$data->_id.'" class="btn btn-xs btn-danger remove-button">
                            <i class="glyphicon glyphicon-trash"></i> Delete
                        </a>';
            })
            ->addColumn('image', function($data){
                return '<div class="img-container">
                            <a href="#" class="zoomable" data-postId="'.$data->_id.'">
                                <img src="'.url($data->images['medium']).'"/>
                            </a>
                            <input id="img-'.$data->_id.'" type="hidden" value="'.$data->images['large'].'">
                        </div>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = Media::find($id);
        $media->keywords = join(", ", $media->keywords);
        return view('admin/photo/edit', ["media"=>$media]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $media = Media::find($id);
        $media->title = $data['title'];
        $media->description = $data['description'];
        $media->keywords = explode(',', $data['keywords']);

        $category = \App\Models\MediaCategory::find($request->category);
        $input_category = [
            'id'=>new ObjectID($request->category),
            'name'=>$category['name']
        ];

        $media->category = $input_category;

        if($media->update()){
            Session::flash('save_success', "Photo data changes has been succcesfully saved");
            return redirect('admin/media/'.$id.'/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Media::destroy($id);
    }
}
