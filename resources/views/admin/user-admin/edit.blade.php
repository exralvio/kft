@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      User Admin
      <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> <a href="{{ url('admin/dashboard') }}">Home</a></li>
      <li class="active"><a href="{{ url('admin/media') }}">User</a></li>
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
                    <h3 class="box-title">{{ $state }} User Admin</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form form-uploader pt-20 pd-20 align-left form-horizontal" autocomplete="off" method="POST" role="form" action="{{ $action }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                @if($state == 'edit')
                                <input type="text" disabled class="form-control" placeholder="email" value="{{ $user->email }}">
                                @else
                                <input type="text" class="form-control" name="email" placeholder="email" value="{{ $user->email }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname" value="{{ $user->firstname }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname" value="{{ $user->lastname }}">
                            </div>
                        </div>
                        
                        @if($state == 'create')
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="box-footer">
                            <a href="{{ url('admin/user-admin') }}"><button type="button" class="btn btn-default">Back</button></a>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('admin_footer_script')
<script type="text/javascript">
    $(document).ready(function() {
        
    })
</script>
@endsection