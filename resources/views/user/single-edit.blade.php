@extends('layouts/global')

@section('page-title')
Edit Profile
@endsection

@section('header_script')
<link rel="stylesheet" href="{{ url('') }}/css/profiles.css">  
@endsection

@section('content')
<section class="page-section pt-80">
  <div class="col-md-6 col-md-push-3 col-sm-12">
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="alert error">
          {{ $error }}
        </div>
      @endforeach
    @endif

    <form class="form profile-form" id="profile_form" method="post" action="{{ url('user/profile') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-12 edit-pp-container">
            <div id="pp-preview">
              <input type="file" name="photo" id="image-upload" accept="image/x-png,image/jpeg" />
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
              <label for="company">Company*</label>
              <select id="company" name="company" class="input-md round form-control" required>
                <option value="">-- Select Company --</option>
                @if(isset($profile['company']))
                  <option value="telkom" {{ $profile['company'] == 'telkom' ? 'selected' : ''}}>Telkom</option>
                  <option value="subsidiaries" {{ $profile['company'] == 'subsidiaries' ? 'selected' : ''}}>Subsidiaries</option>
                @else
                  <option value="telkom">Telkom</option>
                  <option value="subsidiaries">subsidiaries</option>
                @endif
              </select>
          </div>
          <div class="col-md-6">
            <label id="department_lbl" for="department">Department*</label>
            <select id="department" name="department" class="input-md round form-control">
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
          <div class="col-md-6">
            <label id="sister_company_lbl" for="department">Subsidiaries*</label>
            <select id="sister_company" name="sister_company" class="input-md round form-control">
              <option value="">-- Select Subsidiaries --</option>
              @foreach (\App\Models\SisterCompany::all() as $sister_company)
                @if(isset($profile['sister_company']['id']))
                  <option value="{{ $sister_company['_id'] }}" {{ $profile['sister_company']['id'] == $sister_company['_id'] ? 'selected' : ''}}>{{ $sister_company->name }}</option>
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
        <div class="col-md-12  mb-10">
          <div class="col-md-6 mb-10">
            <label for="birthday">Birthday</label>
            <input type="date" name="birthday" id="birthday" name="birthday" class="input-md round form-control" value="{{ $profile['birthday'] }}">
          </div>
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
@endsection

@section('footer_script')
<script type="text/javascript">
    // window.addEventListener("load", function(){
        $(document).ready(function() {
            var photo = "<?php echo url($profile['photo']); ?>";
            var photoUrl = "";
            if(photo.length && photo.indexOf('http') == -1){
              photoUrl = "../"+photo;
            }else if(photo.length && photo.indexOf('http') != -1){
              photoUrl = photo;
            }else{
                photoUrl = "../images/pp-icon.png";
            }
            $('#pp-preview').css({'background':"url("+photoUrl+")","background-size":"contain"});
            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#pp-preview"
            });

            if($('#company').val() == 'telkom'){
              $('#department').show();
              $('#sister_company').hide();
              $('#department_lbl').show();
              $('#sister_company_lbl').hide();
            }else if($('#company').val() == 'subsidiaries'){
              $('#department').hide();
              $('#sister_company').show();
              $('#department_lbl').hide();
              $('#sister_company_lbl').show();
            }else{
              $('#department').hide();
              $('#sister_company').hide();
              $('#department_lbl').hide();
              $('#sister_company_lbl').hide();
            }

            $('#company').change(function(){
              if($(this).val() == 'telkom'){
                //show department & hide sister
                $('#department').show();
                $('#sister_company').hide();
                $('#department_lbl').show();
                $('#sister_company_lbl').hide();
              }else if($(this).val() == 'subsidiaries'){
                //hide department & show sister
                $('#department').hide();
                $('#sister_company').show();
                $('#department_lbl').hide();
                $('#sister_company_lbl').show();
              }else{
                //hide all
                $('#department').hide();
                $('#sister_company').hide();
                $('#department_lbl').hide();
                $('#sister_company_lbl').hide();
              }
            })
        });
    // });
</script>
@endsection