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
        @if(Session::has('email_not_registered'))
        <div class="row">
            <div class="col-sm-12 col-md-4 col-md-offset-4">
                <div class="row">
                    <div class="alert error">
                        <i class="fa fa-lg fa-check-circle-o"></i> {{ Session::get('email_not_registered') }}
                    </div>
                </div>
            </div>    
        </div>
        @elseif(Session::has('reset_email_sent'))
        <div class="row">
            <div class="col-sm-12 col-md-4 col-md-offset-4">
                <div class="row">
                    <div class="alert success">
                        <i class="fa fa-lg fa-check-circle-o"></i> {{ Session::get('reset_email_sent') }}
                    </div>
                </div>
            </div>    
        </div>
        @elseif(Session::has('email_failed_to_send'))
        <div class="row">
            <div class="col-sm-12 col-md-4 col-md-offset-4">
                <div class="row">
                    <div class="alert error">
                        <i class="fa fa-lg fa-check-circle-o"></i> {{ Session::get('email_failed_to_send') }}
                    </div>
                </div>
            </div>    
        </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-md-offset-3 bg-gray-lighter pb-40 reset-container">
                <div class="reset-title align-center">Recover Password</div>
                <hr>
                <p>Please enter your username or email to reset your password. You’ll receive an email with instructions. If you are experiencing problems with remembering your username or email, please contact us at KFT Support.</p>
                <form class="form contact-form" id="contact_form" method="post" action="{{ url('recover-password-mail') }}">
                    {{ csrf_field() }}
                    <div class="clearfix">
                        <!-- email -->
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="input-md round form-control" placeholder="Enter Your Email" pattern=".{3,100}" required>
                            @if ($errors->has('email_invalid'))
                                <span class="text-danger">{{ $errors->first('email_invalid') }}</span>
                            @endif
                        </div>

                        <div>
                            <div class="align-right pt-10">
                                <button class="submit_btn btn btn-mod btn-medium btn-round" id="login-btn">Recover</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection