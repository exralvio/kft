@extends('layouts/timeline')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')
<style type="text/css">
    .reset-container{
        background-color: #ffffff;
    }
    .reset-title{
        font-size: 30px;
        margin-top: 10px;
    }
    .reset-container hr{
        margin: 10px 0;
    }
</style>
<section class="page-section pb-50">
    <div class="container relative">
        @if(Session::has('token_invalid'))
        <div class="row">
            <div class="col-sm-12 col-md-4 col-md-offset-4">
                <div class="row">
                    <div class="alert error">
                        <i class="fa fa-lg fa-check-circle-o"></i> {{ Session::get('token_invalid') }}
                    </div>
                </div>
            </div>    
        </div>
        @elseif(Session::has('password_changed'))
        <div class="row">
            <div class="col-sm-12 col-md-4 col-md-offset-4">
                <div class="row">
                    <div class="alert success">
                        <i class="fa fa-lg fa-check-circle-o"></i> {{ Session::get('password_changed') }}
                    </div>
                </div>
            </div>    
        </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-md-offset-3 bg-gray-lighter pb-40 reset-container">
                <div class="reset-title align-center">Reset Your Password</div>
                <hr>
                <form class="form contact-form" id="contact_form" method="post" action="{{ url('reset-password') }}">
                    {{ csrf_field() }}
                    <div class="clearfix">
                        <input type="hidden" name="reset_token" id="reset_token" class="input-md round form-control" value="{{ $token }}" pattern=".{5,100}" required>
                        <!-- email -->
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="input-md round form-control" placeholder="Enter Your Email" pattern=".{5,100}" required>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" id="password" class="input-md round form-control" placeholder="Enter Your New Password" pattern=".{5,100}" required>
                            @if ($errors->has('password_invalid'))
                                <span class="text-danger">{{ $errors->first('password_invalid') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <input type="password" name="confirm_password" id="confirm_password" class="input-md round form-control" placeholder="Retype Your Password" pattern=".{5,100}" required>
                            @if ($errors->has('confirmation_do_not_match'))
                                <span class="text-danger">{{ $errors->first('confirmation_do_not_match') }}</span>
                            @endif
                        </div>

                        <div>
                            <div class="align-right pt-10">
                                <button class="submit_btn btn btn-mod btn-medium btn-round" id="login-btn">Save</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection