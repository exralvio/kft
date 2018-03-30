@extends('layouts/timeline')

@section('page-title')
Edit Profile
@endsection

@section('header_script')
<link rel="stylesheet" href="{{ url('') }}/css/profiles.css">  
@endsection

@section('content')
<section class="page-section pt-80">
  <div class="col-md-6 col-md-push-3 col-sm-12">
    @if(Session::has('error'))
    <div class="row">
      
      <div class="alert error mt-20">
          <i class="fa fa-lg fa-times-circle"></i> {{ Session::get('error') }}
      </div>
    </div>
    @endif
    <form class="form profile-form" id="profile_form" method="post" action="{{ url('user/profile') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-12 edit-pp-container">
            <div id="pp-preview">
              <input type="file" name="photo" id="image-upload" />
            </div>
            <div class="col-md-12 mb-10 align-center" >
              <label for="image-upload" id="pp-image-label">Change Profile Picture</label>
            </div>
        </div>
        <div class="col-md-12 mb-10">
          <div class="col-md-6">
            <label for="firstname">First Name*</label>
            <input type="text" class="input-md round form-control" id="firstname" name="firstname" placeholder="First Name" required value="{{ $profile['firstname'] }}">
            @if ($errors->has('firstname'))
                <span class="text-danger" style="float:left;">{{ $errors->first('firstname') }}</span>
            @endif
          </div>
          <div class="col-md-6">
            <label for="lastname">Last Name</label>
            <input type="text" class="input-md round form-control" id="lastname" name="lastname" placeholder="Last Name" value="{{ $profile['lastname'] }}">
          </div>
        </div>
        <div class="col-md-12  mb-10">
          <div class="col-md-6">
            <label for="department">Department*</label>
            <select id="department" name="department" class="input-md round form-control" required>
              <option value="">-- Select Department --</option>
              @foreach (\App\Models\UserDepartment::all() as $department)
                @if(isset($profile['department']['id']))
                  <option value="{{ $department['_id'] }}" {{ $profile['department']['id'] == $department['_id'] ? 'selected' : ''}}>{{ $department->parent }} - {{ $department->name }}</option>
                @else
                  <option value="{{ $department['_id'] }}" >{{ $department->parent }} - {{ $department->name }}</option>
                @endif
              @endforeach
            </select>
            @if ($errors->has('department'))
                <span class="text-danger" style="float:left;">{{ $errors->first('department') }}</span>
            @endif
          </div>
          <div class="col-md-6 mb-10">
            <label for="birthday">Birthday</label>
            <input type="date" name="birthday" id="birthday" name="birthday" class="input-md round form-control" value="{{ $profile['birthday'] }}">
          </div>
        </div>
        <div class="col-md-12 mb-10">
          <div class="col-md-6">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" class="input-md round form-control">
              <option value="">-- Select Gender --</option>
              <option value="M" {{ $profile['gender'] == 'M' ? 'selected' : '' }}>Male</option>
              <option value="F" {{ $profile['gender'] == 'F' ? 'selected' : '' }}>Female</option>
            </select>
          </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-12">
              <label for="about">About</label>
              <textarea  class="input-md round form-control" id="about" name="about" placeholder="About">{{ $profile['about'] }}</textarea>
            </div>
        </div>
        <div class="pt-20 pb-20 col-md-12 text-right">
          <div class="col-md-12">
            <button type="button" data-remodal-action="cancel" class="btn btn-mod btn-gray btn-small btn-round" id="cancel-btn">Cancel</button>
            <button class="btn btn-mod btn-small btn-round" id="save-profile-btn">Save</button>
          </div>
        </div>
        <div class="clearfix"></div>
    </form> 
  </div>
  
</section>

<script type="text/javascript" src="{{ url('') }}/js/dashboard.js"></script>
<script type="text/javascript">
    window.addEventListener("load", function(){
        $(document).ready(function() {
            var photo = "<?php echo $profile['photo']; ?>";
            var photoUrl = "";
            if(photo.length){
                photoUrl = "../"+photo;
            }else{
                photoUrl = "../images/pp-icon.png";
            }
            $('#pp-preview').css({'background':"url("+photoUrl+")","background-size":"contain"});
            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#pp-preview"
            });
        });
    });
</script>

@endsection