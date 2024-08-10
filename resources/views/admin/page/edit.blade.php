@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Page
      <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> <a href="{{ url('admin/dashboard') }}">Home</a></li>
      <li class="active"><a href="{{ url('admin/page') }}">page</a></li>
      <li class="active">Edit</li>
    </ol>
</section>

<section class="content">
    @if(Session::has('save_success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Save Success!</h4> {{ Session::get('save_success') }}
    </div>
    @elseif(Session::has('save_failed'))
    <div class="alert alert-error alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Save Failed!</h4> {{ Session::get('save_failed') }}
    </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $state }} Page</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form form-uploader pt-20 pd-20 align-left form-horizontal" autocomplete="off" method="POST" role="form" action="{{ $action }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $page->title }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="slug" pattern="[^' ']+" name="slug" placeholder="Text_Without_Space" value="{{ $page->slug }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" placeholder="Content">{{ $page->content }}</textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{ url('admin/page') }}"><button type="button" class="btn btn-default">Back</button></a>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection