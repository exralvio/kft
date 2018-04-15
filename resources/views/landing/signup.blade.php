@extends('layouts/landing')
 
@section('page-title')
 Sign Up
@endsection

@section('content')       
    <!-- Section -->
    <section class="page-section">
        <div class="container relative">
            @if(Session::has('activation_email_sent'))
            <div class="row">
                <div class="col-sm-12 col-md-4 col-md-offset-4">
                    <div class="row">
                        <div class="alert success">
                            <i class="fa fa-lg fa-check-circle-o"></i> {{ Session::get('activation_email_sent') }}
                        </div>
                    </div>
                </div>    
            </div>
            @endif
            <!-- Registry Form -->                            
            <div class="row">
                <div class="col-md-4 col-md-offset-4  bg-gray-lighter pb-40">
                    <h1 class="align-center">Sign Up To KFT</h1>
                    <form class="form contact-form" id="contact_form" method="post" action="{{ url('signup') }}">
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
                            
                            <!-- Re-enter Password -->
                            <!-- <div class="form-group">
                                <input type="password" name="re-password" id="re-password" class="input-md round form-control" placeholder="Re-enter Password" pattern=".{5,100}" required>
                            </div> -->
                                
                        </div>
                        
                        <!-- Send Button -->
                        <div class="pt-10">
                            <button class="submit_btn btn btn-mod btn-medium btn-round btn-full" id="reg-btn">Register</button>
                        </div>

                        <div class="or-login-with" style="text-align: center;">
                            <span>OR</span>
                        </div>

                        <div class="clearfix">
                            <a class="btn btn-block btn-social btn-facebook" href="{{ url('login/facebook') }}">
                                <span class="fa fa-facebook"></span> Sign up with Facebook
                            </a>
                            <!-- <a class="btn btn-block btn-social btn-twitter" href="{{ url('login/twitter') }}">
                                <span class="fa fa-twitter"></span> Sign in with Twitter
                            </a> -->
                            <a class="btn btn-block btn-social btn-google" href="{{ url('login/google') }}">
                                <span class="fa fa-google"></span> Sign up with Google
                            </a>
                        </div>
                        
                    </form>
                    
                </div>
            </div>
            <!-- End Registry Form -->
                
            
        </div>
    </section>
    <!-- End Section -->
@endsection