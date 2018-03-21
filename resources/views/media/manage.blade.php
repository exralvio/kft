@extends('layouts/timeline')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('css/manage.css') }}">
@endsection
 
@section('page-title')
 Manage Photos
@endsection
     
@section('content')       
    <!-- Section -->
    <section class="page-section pt-80 pb-0">
        <div class="relative">
            <div class="row">
                <div class="col-md-2 manage-left">
                    <div class="manage-header row first-row">
                        <button class="manage-uploadbtn">Upload To Library</button>
                    </div>
                    <div class="manage-categories mt-20">
                        <h4>Photos</h4>
                        <ul>
                            <li><a href="#" class="active">All Photos <span>10</span></a></li>
                            <li><a href="#">Public <span>5</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-7 manage-center">
                    <div class="manage-header row">
                        <h5>All Photos</h5> <span>10 Photos</span>
                    </div>
                    <div class="manage-media">
                    </div>
                </div>
                <div class="col-md-3 manage-right">
                    <form class="form form-editor mb-20 pd-20 align-left" role="form" action="{{ url('confirmUpload') }}">
                        <!-- <div class="form-blocker"></div> -->
                        <div class="relative">
                          <h3>Editing 1 Photo</h3>

                          <div class="mb-20 mb-md-10">
                            <label>Category</label>
                            {{ Form::select('department', App\Models\MediaCategory::pluck('name', '_id'), null, ['placeholder'=>'Uncategorized', 'class'=>'input-md form-control upload-category']) }}
                          </div> 
                          <div class="mb-20 mb-md-10">
                            <label>Title</label>
                            <input type="text" placeholder="Untitled" class="form-control input-md upload-title">
                          </div> 
                          <div class="mb-20 mb-md-10">
                            <label>Description</label>
                            <textarea placeholder="None" class="form-control input-md upload-description"></textarea>
                          </div>
                          <div class="mb-20 mb-md-10">
                            <label>Keywords</label>
                            <div>
                              <input class="upload-keywords" type="text" name="" data-role="tagsinput">
                            </div>
                          </div>
                          <div>
                                <label>EXIF Info</label>
                          </div>
                          <div class="exif-edit mb-20 mb-md-10">
                              
                              <div class="mb-10 row">
                                <label class="col-sm-4">Camera</label>
                                <div class="col-sm-8">
                                    <input class="form-control input-md" type="text" name="">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">Lens</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md" type="text" name="">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">Focal Length</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md" type="text" name="">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">Shutter Speed</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md" type="text" name="">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">Aperture</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md" type="text" name="">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">ISO</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md" type="text" name="">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">Date Taken</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md" type="text" name="">
                                </div>
                              </div>
                          </div>
                          <div>
                              <a class="btn btn-mod btn-round btn-small btn-remove-media">Delete this photo</a>
                          </div>

                          <input type="hidden" class="media-id" name="">
                        </div>
                      </form> 
                    <div class="form-editor-save pt-20">
                        <div class="col-sm-4">                        
                            <a href="#" class="btn btn-lg btn-cancel">Cancel</a>
                        </div>
                        <div class="col-sm-8">                        
                            <button class="btn btn-editor-save btn-success btn-lg btn-round">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
@endsection

@section('footer_script')
    <script type="text/javascript" src="{{ url('js/manage.js') }}"></script>
@endsection