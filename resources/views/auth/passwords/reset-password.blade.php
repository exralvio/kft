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
        <div class="row">
            <div class="col-md-6 col-md-offset-3 bg-gray-lighter pb-40 reset-container">
                <div class="reset-title align-center">Reset Your Password</div>
                <hr>
                <form class="form contact-form" id="contact_form" method="post" action="{{ url('reset-password') }}">
                    {{ csrf_field() }}
                    <div class="clearfix">
                        <!-- email -->
                        <div class="form-group">
                            <input type="hidden" name="email" id="email" class="input-md round form-control" pattern=".{5,100}" value="{{ $email }}" required>
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