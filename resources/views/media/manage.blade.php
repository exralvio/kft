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
                        <a href="#uploader" class="manage-uploadbtn">
                          @if($media_type == 'public')
                            Upload to Profile
                          @else
                            Upload to Library
                          @endif
                        </a>
                    </div>
                    <div class="manage-categories mt-20">
                        <h4>Photos</h4>
                        <ul>
                            <li><a href="{{ url('manage/all') }}" class="{{ $media_type == 'all' ? 'active' : '' }}">All Photos <span>{{ \App\Models\Media::selfMediaCount('all') }}</span></a></li>
                            <li><a href="{{ url('manage/public') }}" class="{{ $media_type == 'public' ? 'active' : '' }}">Public <span>{{ \App\Models\Media::selfMediaCount('public') }}</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-7 manage-center">
                    <div class="manage-header row">
                        @if($media_type == 'public')
                          <h5>Public</h5> <span>{{ \App\Models\Media::selfMediaCount('public') }} Photos</span>
                        @else
                          <h5>All Photos</h5> <span>{{ \App\Models\Media::selfMediaCount('all') }} Photos</span>
                        @endif
                    </div>
                    <div class="manage-media pt-20 row">
                      @foreach(\App\Models\Media::selfMedia() as $media)
                        <div class="col-sm-3 mb-20 manage-item">
                          <div class="manage-item-inner" data-media-id="{{ $media['_id'] }}">
                            <div class="manage-item-icon">
                              <a href="{{ url($media['images']['large']) }}" class="manage-item-zoom pull-left work-lightbox-link mfp-image"><i class="fa fa-search-plus"></i></a>
                              <a href="{{ url('/media/'.$media['_id']) }}" target="_blank" class="manage-item-detail pull-right"><i class="fa fa-external-link"></i></a>
                            </div>
                            <img src="{{ url($media['images']['medium']) }}">
                          </div>
                        </div>
                        @if($loop->iteration % 4 == 0)
                          <div class="clearfix"></div>
                        @endif
                      @endforeach
                    </div>
                </div>
                <div class="col-md-3 manage-right">
                    <form class="form form-editor mb-20 pd-20 align-left" role="form" action="{{ url('media/update') }}">
                        <div class="form-blocker"></div>
                        <div class="relative">
                          <h3>Editing 1 Photo</h3>
                          @csrf
                          <div class="mb-20 mb-md-10">
                            <label>Category</label>
                            {{ Form::select('category',  array(''=>'Uncategorized') + (App\Models\MediaCategory::pluck('name', '_id')->all()), null, ['placeholder'=>'Uncategorized', 'class'=>'input-md form-control edit-category']) }}
                          </div> 
                          <div class="mb-20 mb-md-10">
                            <label>Title</label>
                            <input type="text" placeholder="Untitled" class="form-control input-md edit-title" name="title">
                          </div> 
                          <div class="mb-20 mb-md-10">
                            <label>Description</label>
                            <textarea placeholder="None" name="description" class="form-control input-md edit-description"></textarea>
                          </div>
                          <div class="mb-20 mb-md-10">
                            <label>Keywords</label>
                            <div>
                              <input class="edit-keywords" type="text" name="keywords" data-role="tagsinput">
                            </div>
                          </div>
                          <div>
                                <label>EXIF Info</label>
                          </div>
                          <div class="exif-edit mb-20 mb-md-10">
                              
                              <div class="mb-10 row">
                                <label class="col-sm-4">Camera</label>
                                <div class="col-sm-8">
                                    <input class="form-control input-md edit-camera" type="text" name="exif[camera]">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">Lens</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md edit-lens" type="text" name="exif[lens]">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">Focal Length</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md edit-fl" type="text" name="exif[focal_length]">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">Shutter Speed</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md edit-ss" type="text" name="exif[shutter_speed]">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">Aperture</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md edit-aperture" type="text" name="exif[aperture]">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">ISO</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md edit-iso" type="text" name="exif[iso]">
                                </div>
                              </div>
                              <div class="mb-10 row">
                                <label class="col-sm-4">Date Taken</label>
                                <div class="col-sm-8">
                                     <input class="form-control input-md edit-dt" type="text" name="exif[date_taken]">
                                </div>
                              </div>
                          </div>
                          <div>
                              <a class="btn btn-mod btn-round btn-small btn-remove-media" data-action="{{ url('media/remove') }}">Delete this photo</a>
                          </div>

                          <input type="hidden" class="edit-mediaid" name="media_id">
                        </div>
                      </form> 
                    <div class="form-editor-save pt-20">
                        <div class="col-sm-4">                        
                            <a href="#" class="btn btn-lg btn-cancel">Cancel</a>
                        </div>
                        <div class="col-sm-8">                        
                            <button class="btn btn-editor-save btn-success btn-lg btn-round" disabled>Save</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
@endsection

@section('footer_script')
    <script type="text/javascript">
      var medias = {};

      @foreach(\App\Models\Media::all() as $media)
        medias["{{ $media['_id'] }}"] = JSON.parse('{!! $media->toJson() !!}');
      @endforeach
    </script>
    <script type="text/javascript" src="{{ url('js/manage.js') }}"></script>
@endsection