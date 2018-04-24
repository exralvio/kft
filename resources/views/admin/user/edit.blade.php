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
                        <img style="width: 100%;height: auto;" src="{{ url($user->photo) }}">
                    </div>
                    <form class="form form-uploader pt-20 pd-20 align-left form-horizontal" method="POST" role="form" action="{{ route('user.update', $user->_id) }}">
                        {{ csrf_field() }}
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
                        
                        <div class="form-group">
                                <label for="lastname" class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                                <select id="gender" name="gender" class="input-md round form-control">
                                    <option value="">-- Select Gender --</option>
                                    <option value="M" {{ $user['gender'] == 'M' ? 'selected' : '' }}>Male</option>
                                    <option value="F" {{ $user['gender'] == 'F' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">Verified</label>
                            <div class="col-sm-10">
                                <select id="is_verified" name="is_verified" class="input-md round form-control">
                                    <option value="true" {{ $user['is_verified'] == true ? 'selected' : '' }}>Yes</option>
                                    <option value="false" {{ $user['is_verified'] == false ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">About</label>
                            <div class="col-sm-10">
                                <textarea name="about" class="form-control">{{ $user->about }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="company" class="col-sm-2 control-label">Company*</label>
                            <div class="col-sm-10">
                                <select id="company" name="company" class="input-md round form-control" required>
                                    <option value="">-- Select Company --</option>
                                    @if(isset($user['company']))
                                    <option value="telkom" {{ $user['company'] == 'telkom' ? 'selected' : ''}}>Telkom</option>
                                    <option value="subsidiaries" {{ $user['company'] == 'subsidiaries' ? 'selected' : ''}}>Subsidiaries</option>
                                    @else
                                    <option value="telkom">Telkom</option>
                                    <option value="subsidiaries">subsidiaries</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group" id="department-container">
                            <label class="col-sm-2 control-label" for="department">Department*</label>
                            <div class="col-sm-10">
                                <select id="department" name="department" class="input-md round form-control">
                                    <option value="">-- Select Department --</option>
                                    @foreach (\App\Models\UserDepartment::all() as $department)
                                    @if(isset($user['department']['id']))
                                        <option value="{{ $department['_id'] }}" {{ $user['department']['id'] == $department['_id'] ? 'selected' : ''}}>{{ $department->parent }} - {{ $department->name }}</option>
                                    @else
                                        <option value="{{ $department['_id'] }}" >{{ $department->parent }} - {{ $department->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('department'))
                                    <span class="text-danger" style="float:left;">{{ $errors->first('department') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" id="subsidiari-container">
                            <label class="col-sm-2 control-label" for="department">Subsidiaries*</label>
                            <div class="col-sm-10">
                                <select id="sister_company" name="sister_company" class="input-md round form-control">
                                    <option value="">-- Select Subsidiaries --</option>
                                    @foreach (\App\Models\SisterCompany::all() as $sister_company)
                                    @if(isset($profile['sister_company']['id']))
                                        <option value="{{ $sister_company['_id'] }}" {{ $user['sister_company']['id'] == $sister_company['_id'] ? 'selected' : ''}}>{{ $sister_company->name }}</option>
                                    @else
                                        <option value="{{ $sister_company['_id'] }}" >{{ $sister_company->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('sister_company'))
                                    <span class="text-danger" style="float:left;">{{ $errors->first('sister_company') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="box-footer">
                            <a href="{{ url('admin/user') }}"><button type="button" class="btn btn-default">Back</button></a>
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
    if($('#company').val() == 'telkom'){
        $('#department-container').show();
        $('#subsidiari-container').hide();
    }else if($('#company').val() == 'subsidiaries'){
        $('#department-container').hide();
        $('#subsidiari-container').show();
    }else{
        $('#department').hide();
        $('#subsidiari-container').hide();
    }

    $('#company').change(function(){
        if($(this).val() == 'telkom'){
        //show department & hide sister
        $('#department-container').show();
        $('#subsidiari-container').hide();
        }else if($(this).val() == 'subsidiaries'){
        //hide department-container & show sister
        $('#department-container').hide();
        $('#subsidiari-container').show();
        }else{
        //hide all
        $('#department-container').hide();
        $('#subsidiari-container').hide();
        }
    })
})
</script>
@endsection