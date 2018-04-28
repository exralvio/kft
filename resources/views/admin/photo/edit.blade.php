@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Photos
      <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> <a href="{{ url('admin/dashboard') }}">Home</a></li>
      <li class="active"><a href="{{ url('admin/media') }}">Photos</a></li>
      <li class="active">Edit</li>
    </ol>
</section>

<section class="content">
    @if(Session::has('save_success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Save Success!</h4> {{ Session::get('save_success') }}
    </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Photo</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="edit-img-container" style="width:200px;height: auto;overflow: hidden;text-align: center;margin: 10px auto;">
                        <img style="width: 100%;height: auto;" src="{{ url($media->images['medium']) }}">
                    </div>
                    <form class="form form-uploader pt-20 pd-20 align-left form-horizontal" method="POST" role="form" action="{{ route('media.update', $media->_id) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ $media->title }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                {{ Form::select('category',  array(''=>'Uncategorized') + (App\Models\MediaCategory::pluck('name', '_id')->all()), $media->category['id'], ['placeholder'=>'Uncategorized', 'class'=>'input-md form-control edit-category']) }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="Description" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="Description" name="description" placeholder="Description">
                                    {{ $media->description }}
                                </textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="keyword" class="col-sm-2 control-label">Keyword</label>
                            <div class="col-sm-10">
                                <input class="photo-keywords form-control" name="keywords" value="{{ $media->keywords }}" data-role="tagsinput">
                            </div>
                        </div>
                        
                        <div class="col-md-12 text-center"><hr></div>

                        <div class="form-group">
                            <label for="camera" class="col-sm-2 control-label">Camera</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="camera" value="{{ isset($media->exif['camera']) ? $media->exif['camera'] : '' }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="lens" class="col-sm-2 control-label">Lens</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="lens" value="{{ isset($media->exif['lens']) ? $media->exif['lens'] : '' }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="focal_length" class="col-sm-2 control-label">Focal Length</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="focal_length" value="{{ isset($media->exif['focal_length']) ? $media->exif['focal_length'] : '' }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="shutter_speed" class="col-sm-2 control-label">Shutter Speed</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="shutter_speed" value="{{ isset($media->exif['shutter_speed']) ? $media->exif['shutter_speed'] : '' }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="aperture" class="col-sm-2 control-label">Aperture</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="aperture" value="{{ isset($media->exif['aperture']) ? $media->exif['aperture'] : '' }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="iso" class="col-sm-2 control-label">ISO</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="iso" value="{{ isset($media->exif['iso']) ? $media->exif['iso'] : '' }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="date_taken" class="col-sm-2 control-label">Date Taken</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="date_taken" value="{{ isset($media->exif['date_taken']) ? $media->exif['date_taken'] : '' }}">
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{ url('admin/media') }}"><button type="button" class="btn btn-default">Back</button></a>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection