<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PartialContent;
use App\Models\Announcement;
use Yajra\Datatables\Datatables;
use Validator;
use Session;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/announcement/index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        $announcements = Announcement::get();
        return Datatables::of($announcements)
            ->addColumn('action', function ($announcement) {
                return '<a href="'.url('admin/announcement').'/'.$announcement->_id.'/edit" class="btn btn-xs btn-primary">
                            <i class="glyphicon glyphicon-edit"></i> Edit
                        </a>
                        <a data-postId="'.$announcement->_id.'" class="btn btn-xs btn-danger remove-button">
                            <i class="glyphicon glyphicon-trash"></i> Delete
                        </a>';
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
        $announcement = new Announcement;
        $announcement->title = '';
        $announcement->description = '';
        $announcement->link = '';
        $announcement->button = '';
        $announcement->background = '';
        $announcement->start_date = '';
        $announcement->end_date = '';
        $announcement->credit_name = '';
        $announcement->credit_link = '';

        return view('admin.announcement.edit',['announcement'=>$announcement, "action"=>route('announcement.store'), 'state'=>'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect('admin/announcement/create')->withErrors($validator);
        }

        $newAnnouncement = new Announcement;
        $newAnnouncement->title = $request->title;
        $newAnnouncement->description = $request->description;
        $newAnnouncement->link = $request->link;
        $newAnnouncement->button = $request->button;
        $newAnnouncement->background = $request->background;
        $newAnnouncement->start_date = $request->start_date;
        $newAnnouncement->end_date = $request->end_date;
        $newAnnouncement->credit_name = $request->credit_name;
        $newAnnouncement->credit_link = $request->credit_link;
        $newAnnouncement->save();

        if($request->hasFile('background')){
            $original_name = $request->file('background')->getClientOriginalName();

            $extension = File::extension($original_name);
            $directory = 'upload_tmp';
            // $directory = path('public').'uploads/tmp/'.sha1(time());
            $filename = sha1(time().time().rand()).".{$extension}";

            $upload_success = $request->file->storeAs($directory, $filename);    
        }

        Session::flash('save_success', "New Announcement has been succcesfully created");
        return redirect('admin/announcement');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = Announcement::find($id);
        return view('admin/announcement/edit', ["announcement"=>$announcement, "action"=>route('announcement.update', $id), 'state'=>'edit']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
