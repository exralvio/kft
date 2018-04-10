@extends('layouts/global')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content') 
<style type="text/css">
    .forgot-password-container{
        background-color: #ffffff;
    }
    .forgot-password-container hr{
        margin: 10px 0;
    }
    .recover-title{
        font-size: 30px;
        text-align: center;
        margin-top: 15px;
    }
</style>
<section class="page-section pb-50 mt-30">
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
            <div class="col-md-6 col-md-offset-3 bg-gray-lighter">
                <div class="col-md-10 col-md-offset-1 forgot-password-container pb-30">
                    <div class="row recover-title">Recover Password</div><hr>
                    <p>Please enter your username or email to reset your password. You’ll receive an email with instructions. If you are experiencing problems with remembering your username or email, please contact us at KFT Support.</p>
                    <form class="form contact-form" id="contact_form" method="post" action="{{ url('recover-password') }}">
                        {{ csrf_field() }}
                        <div class="clearfix">
                            <!-- email -->
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="input-md round form-control" placeholder="Email" pattern=".{3,100}" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div>        
                                <!-- Send Button -->
                                <div class="align-right pt-10">
                                    <button class="submit_btn btn btn-mod btn-medium btn-round" id="login-btn">Recover</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection