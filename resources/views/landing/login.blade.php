@extends('layouts/global')
 
@section('page-title')
 Login
@endsection
     
@section('content')       
    <style type="text/css">
        .or-login-with{
            width: 100%;
            border-bottom: 1px solid #000;
            line-height: 0.1em;
            margin: 20px 0px;
        }
        .or-login-with span{
            background: #f8f8f8;
            padding: 0 10px;
            font-size: 17px;
            font-weight: bold;
        }
    </style>
    <!-- Section -->
    <section class="page-section pb-50">
        <div class="container relative">
                @if(Session::has('register_success'))
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-md-offset-4">
                        <div class="row">
                            <div class="alert success">
                                <i class="fa fa-lg fa-check-circle-o"></i> {{ Session::get('register_success') }}
                            </div>
                        </div>
                    </div>    
                </div>
                @elseif(Session::has('activation_success'))
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-md-offset-4">
                        <div class="row">
                            <div class="alert success">
                                <i class="fa fa-lg fa-check-circle-o"></i> {{ Session::get('activation_success') }}
                            </div>
                        </div>
                    </div>    
                </div>
                @elseif(Session::has('activation_failed'))
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-md-offset-4">
                        <div class="row">
                            <div class="alert error">
                                <i class="fa fa-lg fa-check-circle-o"></i> {{ Session::get('activation_failed') }}
                            </div>
                        </div>
                    </div>    
                </div>
                @endif

                <!-- Login Form -->                            
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 bg-gray-lighter pb-40">
                        <h1 class="align-center">Log In To KFT</h1>
                        <form class="form contact-form" id="contact_form" method="post" action="{{ url('login') }}">
                            {{ csrf_field() }}
                            <div class="clearfix">
                                
                                <!-- email -->
                                <div class="form-group">
                                    <input type="text" name="email" id="email" class="input-md round form-control" placeholder="Email" pattern=".{3,100}" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                
                                <!-- Password -->
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="input-md round form-control" placeholder="Password" pattern=".{5,100}" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    @if ($errors->has('failedLogin'))
                                        <span class="text-danger">{{ $errors->first('failedLogin') }}</span>
                                    @endif
                                </div>
                                    
                            </div>
                            
                            <div class="clearfix">
                                
                                <div class="cf-left-col">
                                    
                                    <!-- Inform Tip -->                                        
                                    <div class="form-tip pt-20">
                                        <a href="{{url('recover-password')}}">Forgot Password?</a>
                                    </div>
                                    
                                </div>
                                
                                <div class="cf-right-col">
                                    
                                    <!-- Send Button -->
                                    <div class="align-right pt-10">
                                        <button class="submit_btn btn btn-mod btn-medium btn-round" id="login-btn">Login</button>
                                    </div>
                                    
                                </div>
                                
                            </div>

                            <div class="or-login-with" style="text-align: center;">
                                <span>OR</span>
                            </div>

                            <div class="clearfix">
                                <a class="btn btn-block btn-social btn-facebook" href="{{ url('login/facebook') }}">
                                    <span class="fa fa-facebook"></span> Sign in with Facebook
                                </a>
                                <a class="btn btn-block btn-social btn-twitter" href="{{ url('login/twitter') }}">
                                    <span class="fa fa-twitter"></span> Sign in with Twitter
                                </a>
                                <a class="btn btn-block btn-social btn-google" href="{{ url('login/google') }}">
                                    <span class="fa fa-google"></span> Sign in with Google
                                </a>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
                <!-- End Login Form -->
                
            
        </div>
    </section>
    <!-- End Section -->
@endsection