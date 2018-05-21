<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use MongoDB\BSON\ObjectID;
use Validator;
use Session;
use File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::paginate(10);
        return view('admin.setting.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = new Setting;
        $setting->label = '';
        $setting->value = '';

        return view('admin.setting.edit', ['setting'=>$setting, "action"=>route('setting.store'), 'state'=>'create']);
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
            'label' => 'required',
            'value' => 'required',
        );


        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect('admin/setting/create')->withErrors($validator);
        }

        /**
         * prevent duplicate label
        */
        $labelExists = Setting::where('label',$request->label)->first();
        if($labelExists){
            Session::flash('save_failed', "Label '".$request->label."' has been used, please use another label");
            return view('admin.setting.edit',['setting'=>$request, 'state'=>'create', "action"=>route('setting.store')]);
        }

        $newSetting = new Setting;
        $newSetting->label = $request->label;
        $newSetting->value = $request->value;
        $newSetting->save();

        Session::flash('save_success', "New Setting has been succcesfully created");
        return redirect('admin/setting');
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
        $setting = Setting::find($id);
        return view('admin/setting/edit', ["setting"=>$setting, "action"=>route('setting.update', $id), 'state'=>'edit']);
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
        $rules = array(
            'label' => 'required',
            'value' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect('admin/setting/create')->withErrors($validator);
        }

        $input = $request->except(['_token']);

        if($input['type'] == 'upload'){
            $original_name = $request->file('value')->getClientOriginalName();
            $extension = File::extension($original_name);
            $filename = sha1(time().time().rand()).".{$extension}";
            $directory = 'images/settings/';
            $filepath = $directory.$filename;
            
            $request->file('value')->storeAs($directory, $filename, 'public_upload');

            $input['value'] = $filepath;
        }

        /**
         * prevent duplicate label
        */
        $labelExists = Setting::where('label',$request->label)->where('_id','!=',new ObjectId($id))->get();
        if(!$labelExists->isEmpty()){
            Session::flash('save_failed', "Label '".$request->label."' has been used, please use another label");
            return view('admin.setting.edit',['setting'=>$request, 'state'=>'edit', "action"=>route('setting.update', $id)]);
        }

        $update = \DB::collection('settings')->where('_id', $id)->update($input);
        Session::flash('save_success', "Setting data changes has been succcesfully saved");
        return redirect('admin/setting/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PageStatic::destroy($id);
    }
}