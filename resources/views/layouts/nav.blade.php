<?php $route = Route::current() ? Route::current()->uri : ''; ?>
<!-- Navigation panel -->
<nav class="main-nav stick-fixed {{ $route == '/' ? 'transparent': '' }}">
    <div class="full-wrapper relative clearfix">
        <!-- Logo ( * your text or image into link tag *) -->
        <div class="nav-logo-wrap local-scroll">
            <a href="{{ url('/') }}" class="logo logo-white">
                <img src="{{ url('') }}/images/logo-white.png" alt="" />
            </a>
            <a href="{{ url('/') }}" class="logo logo-gray">
                <img src="{{ url('') }}/images/logo-gray.png" alt="" />
            </a>
        </div>
        <div class="mobile-nav">
            <i class="fa fa-bars"></i>
        </div>
        <!-- Main Menu -->
        <div class="inner-nav desktop-nav">
            <ul class="clearlist scroll-nav local-scroll">
                <li><a href="{{ url('about') }}">About</a></li>
                <li><a href="{{ url('discover') }}">Discover</a></li>
            </ul>
        </div>

        @if(\Auth::check()) 
            <!-- Main Menu -->
            <div class="inner-nav desktop-nav login-nav">
                <ul class="clearlist scroll-nav local-scroll">
                    <li>
                        <a href="#" class="mn-has-sub">
                            <span class="visible-xs">Account</span>
                            <span class="nav-avatar visible-lg">
                                <span class="nav-avatar-inner">
                                    @if(!empty(\App\Models\User::currentPhoto())) 
                                    <img class="nav-avatar-image" src="{{ url(\App\Models\User::currentPhoto()) }}" />
                                    @else
                                    <img class="nav-avatar-image" src="{{ url('') }}/rythm/images/user-avatar.png">
                                    @endif
                                </span>
                            </span>
                        </a>
                        
                        <div class="visible-xs visibile-sm">
                            <!-- Sub -->
                            <ul class="mn-sub">
                                <li>
                                    <a href="{{ url('user/profile') }}">My Profile</i></a>
                                </li>
                                <li>
                                    <a href="{{ url('user/edit') }}">My Settings</i></a>
                                </li>
                                <li>
                                    <a href="{{ url('manage') }}">Manage Photos</i></a>
                                </li>
                                <li>
                                    <a href="{{ url('logout') }}">Logout</i></a>
                                </li>
                            </ul>
                            <!-- End Sub -->
                        </div>

                        <div class="visible-md visible-lg">
                            <div class="setting-box">
                                <ul>
                                    <li>
                                        <a href="{{ url('user/profile') }}">My Profile</i></a>
                                    </li>
                                    <li>
                                        <a href="{{ url('user/edit') }}">My Settings</i></a>
                                    </li>
                                    <li>
                                        <a href="{{ url('manage') }}">Manage Photos</i></a>
                                    </li>
                                    <li>
                                        <a href="{{ url('logout') }}">Logout</i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                    </li>
                    <!-- End Item With Sub -->
                    <li>
                        <a href="#" class="nav-notification">
                            <span class="visible-lg"><i class="fa fa-bell-o nav-notification-icon"></i> 
                                <span id="activeNotification" style="display:none;"></span>
                            </span>
                            <span class="visible-xs"><i class="fa fa-bell-o"></i> Notification</span>
                        </a>
                        <div class="notification-box">
                            <h3>NOTIFICATIONS</h3>
                            <div class="notification-inner">
                                <ul class="notification-list">
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ !\App\Models\User::isActive() ? url('/') : '' }}" class="nav-upload {{ \App\Models\User::isActive() ? 'upload-btn' : '' }}">
                           <i class="fa fa-cloud-upload"></i> Upload
                        </a>
                    </li>
                </ul>
            </div>

            <div class="search-box visible-md visible-lg pull-right col-md-4">
                <form action="{{ url('search') }}" class="form">
                    <input type="text" name="q" class="form-control form-md" autocomplete="off" value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}" >
                    <select name="type" class="form-control form-md">
                        <option value="photos" {{ isset($_GET['type']) && $_GET['type'] == 'photos' ? 'selected' : '' }}>Photo</option>
                        <option value="users" {{ isset($_GET['type']) && $_GET['type'] == 'users' ? 'selected' : '' }}>User</option>
                    </select>
                    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-search"></i></button>
                </form>
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

@if(\Auth::check())
    @include('user/edit-profile')
@endif