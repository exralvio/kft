@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Announcement
      <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> <a href="{{ url('admin/dashboard') }}">Home</a></li>
      <li class="active"><a href="{{ url('admin/announcement') }}">announcement</a></li>
      <li class="active">Edit</li>
    </ol>
</section>

<section class="content">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
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
                    <h3 class="box-title">{{ $state }} Announcement</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form form-uploader pt-20 pd-20 align-left form-horizontal" autocomplete="off" method="post" role="form" action="{{ $action }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title*</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $announcement->title }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" placeholder="Description">{{ $announcement->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="background" class="col-sm-2 control-label">Background</label>
                            <div class="col-sm-10">
                                <input type="file" name="background">

                                @if(!empty($announcement['background']))
                                    <img src="{{ url($announcement['background']) }}" style="margin: 10px 0 0; max-height: 150px;">
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="button" class="col-sm-2 control-label">Button text</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="button" name="button" placeholder="none" value="{{ $announcement->button }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="link" class="col-sm-2 control-label">Button link</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="link" name="link" placeholder="none" value="{{ $announcement->link }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="credit_name" class="col-sm-2 control-label">Credit name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="credit_name" name="credit_name" placeholder="none" value="{{ $announcement->credit_name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="credit_link" class="col-sm-2 control-label">Credit link</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="credit_link" name="credit_link" placeholder="none" value="{{ $announcement->credit_link }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start_date" class="col-sm-2 control-label">Start date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control is-datepicker" id="start_date" name="start_date" placeholder="none" value="{{ $announcement->start_date }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end_date" class="col-sm-2 control-label">End date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control is-datepicker" id="end_date" name="end_date" placeholder="none" value="{{ $announcement->end_date }}">
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{ url('admin/announcement') }}"><button type="button" class="btn btn-default">Back</button></a>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('header_script')
<link rel="stylesheet" type="text/css" href="{{ url('') }}/admin_lte/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endsection

@section('admin_footer_script')
<script type="text/javascript" src="{{ url('') }}/admin_lte/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.is-datepicker').datepicker({
             format: 'yyyy-mm-dd',
            startDate: 'd'
        });
    });
</script>
@endsection