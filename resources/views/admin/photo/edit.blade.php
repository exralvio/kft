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
    <div class="row">
        <div class="col-sm-12 col-md-4 col-md-offset-4">
            <div class="row">
                <div class="alert success">
                    <i class="fa fa-lg fa-check-circle-o"></i> {{ Session::get('save_success') }}
                </div>
            </div>
        </div>    
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