<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PartialContent;
use MongoDB\BSON\ObjectID;
use Validator;
use Session;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = PartialContent::paginate(10);
        return view('admin.page.index',['contents'=>$content]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = new PartialContent;
        $page->title = '';
        $page->slug = '';
        $page->content = '';

        return view('admin.page.edit',['page'=>$page, "action"=>route('page.store'), 'state'=>'create']);
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
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect('admin/page/create')->withErrors($validator);
        }

        /**
         * prevent duplicate slug
        */
        $slugExists = PartialContent::where('slug',$request->slug)->first();
        if($slugExists){
            Session::flash('save_failed', "Slug '".$request->slug."' has been used, please use another slug");
            return view('admin.page.edit',['page'=>$request, 'state'=>'create', "action"=>route('page.store')]);
        }

        $newPage = new PartialContent;
        $newPage->title = $request->title;
        $newPage->slug = $request->slug;
        $newPage->content = $request->content;
        $newPage->save();

        Session::flash('save_success', "New Page has been succcesfully created");
        return redirect('admin/page');
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
        $page = PartialContent::find($id);
        return view('admin/page/edit', ["page"=>$page, "action"=>route('page.update', $id), 'state'=>'edit']);
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
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect('admin/page/create')->withErrors($validator);
        }

        $collection = collect($request->all());

        /**
         * prevent duplicate slug
        */
        $slugExists = PartialContent::where('slug',$request->slug)->where('_id','!=',new ObjectId($id))->get();
        if(!$slugExists->isEmpty()){
            Session::flash('save_failed', "Slug '".$request->slug."' has been used, please use another slug");
            return view('admin.page.edit',['page'=>$request, 'state'=>'edit', "action"=>route('page.update', $id)]);
        }

        $update = \DB::collection('partial_contents')->where('_id', $id)->update($collection->all());
        Session::flash('save_success', "Page data changes has been succcesfully saved");
        return redirect('admin/page/'.$id.'/edit');
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