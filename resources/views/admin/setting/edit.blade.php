@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Setting
      <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> <a href="{{ url('admin/dashboard') }}">Home</a></li>
      <li class="active"><a href="{{ url('admin/setting') }}">setting</a></li>
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
                    <h3 class="box-title">{{ $state }} Setting</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form form-uploader pt-20 pd-20 align-left form-horizontal" autocomplete="off" method="POST" role="form" action="{{ $action }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="type" value="{{ $setting->type }}">
                        
                        <div class="form-group">
                            <label for="label" class="col-sm-2 control-label">Label</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="label" pattern="[^' ']+" name="label" placeholder="Text_Without_Space" value="{{ $setting->label }}" readonly="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="value" class="col-sm-2 control-label">Value</label>
                            <div class="col-sm-10">
                                @if($setting->type == 'bool')
                                    <select name="value" id="value" class="form-control">
                                        <option value="0" {{ $setting->value == 0 ? 'selected' : '' }}>Disable</option>
                                        <option value="1" {{ $setting->value == 1 ? 'selected' : '' }}>Enable</option>
                                    </select>
                                @elseif($setting->type == 'upload')
                                    <input type="file" name="value" class="form-control" id="value">

                                    @if(!empty($setting->value))
                                        <br>
                                        Current: <br>
                                        <img src="{{ url($setting->value) }}" style="max-width:300px;">
                                    @endif
                                @else
                                    <input type="text" class="form-control" id="value" name="value" placeholder="Value" value="{{ $setting->value }}">
                                @endif
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{ url('admin/setting') }}"><button type="button" class="btn btn-default">Back</button></a>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection