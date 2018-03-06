@extends('layouts/global')
 
@section('page-title')
 Login
@endsection
     
@section('content')       
    <!-- Section -->
    <section class="page-section pb-50 mt-30">
        <div class="container relative">

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
                                    
                            </div>
                            
                            <div class="clearfix">
                                
                                <div class="cf-left-col">
                                    
                                    <!-- Inform Tip -->                                        
                                    <div class="form-tip pt-20">
                                        <a href="">Forgot Password?</a>
                                    </div>
                                    
                                </div>
                                
                                <div class="cf-right-col">
                                    
                                    <!-- Send Button -->
                                    <div class="align-right pt-10">
                                        <button class="submit_btn btn btn-mod btn-medium btn-round" id="login-btn">Login</button>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
                <!-- End Login Form -->
                
            
        </div>
    </section>
    <!-- End Section -->
@endsection