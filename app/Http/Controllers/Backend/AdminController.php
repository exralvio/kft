<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use MongoDB\BSON\ObjectID;
use Session;
use File;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Admin::paginate(10);
        return view('admin.user-admin.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = new Admin;
        $admin->email = '';
        $admin->firstname = '';
        $admin->lastname = '';

        return view('admin.user-admin.edit',['user'=>$admin, "action"=>route('useradmin.create'), 'state'=>'create']);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        $datas = Admin::get();
        return Datatables::of($datas)
            ->addColumn('action', function ($data) {
                $editButton =   '<a href="'.url('admin/user-admin').'/'.$data->_id.'/edit" class="btn btn-xs btn-primary">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                </a>';
                $delButton  =   '<a data-postId="'.$data->_id.'" class="btn btn-xs btn-danger remove-button">
                                    <i class="glyphicon glyphicon-trash"></i> Delete
                                </a>'; 

                $result = $editButton;
                if($data->admin_role != 'Superadmin'){
                    $result .= '&nbsp;'.$delButton;
                }
                return $result;
            })->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $admin = array(
            'email' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make($request->all(), $admin);
        if($validator->fails()){
            return redirect('admin/user-admin/create')->withErrors($validator);
        }

        $newAdmin = new Admin();
        $newAdmin->email = $request->email;
        $newAdmin->firstname = $request->firstname;
        $newAdmin->lastname = $request->lastname;
        $newAdmin->admin_role = 'Admin';
        $newAdmin->fullname = $request->firstname." ".$request->lastname;
        $newAdmin->password = bcrypt($request->password);
        $newAdmin->save();
        Session::flash('save_success', "New Admin has been succcesfully created");
        return redirect('admin/user-admin');
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
        $user = Admin::find($id);
        return view('admin/user-admin/edit', ["user"=>$user, "action"=>route('useradmin.update', $id), 'state'=>'edit']);
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
        $collection = collect($request->all());
        $collection->put('fullname', $request->firstname." ".$request->lastname);

        // $user = User::find($id);
        $update = \DB::collection('admins')->where('_id', $id)->update($collection->all());
        Session::flash('save_success', "Admin data changes has been succcesfully saved");
        return redirect('admin/user-admin/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::destroy($id);
    }
}
