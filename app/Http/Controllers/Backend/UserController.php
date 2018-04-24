<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use MongoDB\BSON\ObjectID;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.user.index',['users'=>$users]);
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
        $user = User::find($id);
        return view('admin/user/edit', ["user"=>$user]);
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
        
        $department = \App\Models\UserDepartment::find($request->department);
        $input_department = [
            'id'=>new ObjectID($department['_id']),
            'name'=>$department['parent'].' '.$department['name']
        ];

        $sister_company = \App\Models\SisterCompany::find($request->sister_company);
        $input_sister_company = [
            'id'=>new ObjectID($sister_company['_id']),
            'name'=>$sister_company['name']
        ];

        /**
         * set one child to null
        */
        if($request->company == 'sister_company'){
            $input_department = [];
        }else if($request->company == 'telkom'){
            $input_sister_company = [];
        }

        $request->merge([
            'is_active'=>true, 
            'department'=>$input_department,
            'sister_company'=>$input_sister_company,
            'fullname'=>!empty($request->lastname) ? $request->firstname.' '.$request->lastname : $request->firstname
        ]);
        
        $collection = collect($request->all());
        // dd($collection);
        // $user = User::find($id);
        $update = \DB::collection('users')->where('_id', $id)->update($collection->all());
        Session::flash('save_success', "User data changes has been succcesfully saved");
        return redirect('admin/user/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
}
