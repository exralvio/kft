<?php $route = Route::current()->uri; ?>
<!-- Navigation panel -->
<nav class="main-nav stick-fixed {{ $route == '/' ? 'transparent': '' }}">
    <div class="full-wrapper relative clearfix">
        <!-- Logo ( * your text or image into link tag *) -->
        <div class="nav-logo-wrap local-scroll">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ url('') }}/images/logo-kft.png" alt="" />
            </a>
        </div>
        <div class="mobile-nav">
            <i class="fa fa-bars"></i>
        </div>
        <!-- Main Menu -->
        <div class="inner-nav desktop-nav">
            <ul class="clearlist scroll-nav local-scroll">
                <li><a href="#about">About</a></li>
                <li><a href="#services">Help</a></li>
                <li><a href="{{ url('discover') }}">Discover</a></li>
            </ul>
        </div>

        @if(\Auth::check()) 
            <!-- Main Menu -->
            <div class="inner-nav desktop-nav login-nav">
                <ul class="clearlist scroll-nav local-scroll">
                    <!-- Search -->
                    <li>
                        <a href="#" class="mn-has-sub"><i class="fa fa-search"></i> Search</a>
                        
                        <ul class="mn-sub">
                            
                            <li>
                                <div class="mn-wrap">
                                    <form method="post" class="form">
                                        <div class="search-wrap">
                                            <button class="search-button animate" type="submit" title="Start Search">
                                                <i class="fa fa-search"></i>
                                            </button>
                                            <input type="text" class="form-control search-field" placeholder="Search...">
                                        </div>
                                    </form>
                                </div>
                            </li>
                            
                        </ul>
                        
                    </li>
                    <!-- End Search -->
                    <!-- Item With Sub -->
                    <li>
                        <a href="#" class="mn-has-sub">
                            <span class="visible-xs">Account</span>
                            <span class="nav-avatar visible-lg">
                                @if(Session::has('user')) 
                                <img src="{{ Session::get('user')->photo }}" />
                                @else
                                <img src="{{ url('') }}/rythm/images/user-avatar.png">
                                @endif
                            </span>
                        </a>
                        
                        <!-- Sub -->
                        <ul class="mn-sub">
                            <li>
                                <a href="{{ url('user/profile') }}">My Profile</i></a>
                            </li>
                            <li>
                                <a href="#">My Settings</i></a>
                            </li>
                            <li>
                                <a href="#">Manage Photos</i></a>
                            </li>
                            <li>
                                <a href="{{ url('logout') }}">Logout</i></a>
                            </li>
                        </ul>
                        <!-- End Sub -->
                        
                    </li>
                    <!-- End Item With Sub -->
                    <li>
                        <a href="#" class="nav-notification">
                            <span class="visible-lg"><i class="fa fa-bell-o"></i> </span>
                            <span class="visible-xs"><i class="fa fa-bell-o"></i> Notification</span>
                        </a>
                    </li>
                    <li>
                        <a href="#uploader" class="nav-upload upload-btn">
                           <i class="fa fa-cloud-upload"></i> Upload
                        </a>
                    </li>
                </ul>
            </div>
        @else
            <div class="inner-nav desktop-nav login-nav">
                <ul class="clearlist scroll-nav local-scroll">
                    <li><a href="{{ url('login') }}">Login</a></li>
                    <li><a href="{{ url('signup') }}" class="nav-signup">Sign up</a></li>
                </ul>
            </div>
        @endif
    </div>
</nav>
<!-- End Navigation panel -->