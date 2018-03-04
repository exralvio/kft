<!DOCTYPE html>
<html>
    <head>
        <title>KFT | Login</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta charset="utf-8">
        <meta name="author" content="Roman Kirichik">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        
        <!-- Favicons -->
        <link rel="shortcut icon" href="images/favicon.png">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
        
        <!-- CSS -->
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/style.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/style-responsive.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/custom.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/animate.min.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/vertical-rhythm.min.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/owl.carousel.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/magnific-popup.css">        

        
    </head>
    <body class="appear-animate">
        
        <!-- Page Loader -->        
        <div class="page-loader">
            <div class="loader">Loading...</div>
        </div>
        <!-- End Page Loader -->
        
        <!-- Page Wrap -->
        <div class="page" id="top">
            
            <!-- Navigation panel -->
            <nav class="main-nav stick-fixed">
                <div class="full-wrapper relative clearfix">
                    <!-- Logo ( * your text or image into link tag *) -->
                    <div class="nav-logo-wrap local-scroll">
                        <a href="#top" class="logo">
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
                            <li><a href="#discover">Discover</a></li>
                        </ul>
                    </div>
                    <!-- Main Menu -->
                    <div class="inner-nav desktop-nav login-nav">
                        <ul class="clearlist scroll-nav local-scroll">
                            <li><a href="{{ url('login') }}">Login</a></li>
                            <li><a href="{{ url('signup') }}" class="nav-signup">Sign up</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navigation panel -->
            
            <!-- Section -->
            <section class="page-section">
                <div class="container relative">

                        <!-- Login Form -->                            
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 bg-gray-lighter pb-40">
                                <h1 class="align-center">Log In To KFT</h1>
                                <form class="form contact-form" id="contact_form">
                                    <div class="clearfix">
                                        
                                        <!-- Username -->
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" class="input-md round form-control" placeholder="Username" pattern=".{3,100}" required>
                                        </div>
                                        
                                        <!-- Password -->
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="input-md round form-control" placeholder="Password" pattern=".{5,100}" required>
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
            
            
            <!-- Foter -->
            <footer class="page-section bg-gray-lighter footer">
                <div class="container">
                    
                   
                    
                    <!-- Footer Text -->
                    <div class="footer-text">
                        
                        <!-- Copyright -->
                        <div class="footer-copy font-alt">
                            &copy; Komunitas Fotografi Telkom 2018.
                        </div>
                        <!-- End Copyright -->
                        
                    </div>
                    <!-- End Footer Text --> 
                    
                    <!-- Footer Logo -->
                    <div class="footer-sponsor">
                        <p>Sponsored By</p>
                        <img src="{{ url('') }}/images/telkom.png" alt="Telkom Indonesia" />
                    </div>
                    <!-- End Footer Logo -->
                 </div>
                 
                 
                 <!-- Top Link -->
                 <div class="local-scroll">
                     <a href="#top" class="link-to-top"><i class="fa fa-caret-up"></i></a>
                 </div>
                 <!-- End Top Link -->
                 
            </footer>
            <!-- End Foter -->
        
        
        </div>
        <!-- End Page Wrap -->
        
        
        <!-- JS -->
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/bootstrap.min.js"></script>        
        <script type="text/javascript" src="{{ url('') }}/rythm/js/SmoothScroll.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.scrollTo.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.localScroll.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.viewport.mini.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.countTo.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.appear.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.sticky.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.parallax-1.1.3.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.fitvids.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/isotope.pkgd.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/imagesloaded.pkgd.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.magnific-popup.min.js"></script>

        <script type="text/javascript" src="{{ url('') }}/rythm/js/wow.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/masonry.pkgd.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.simple-text-rotator.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/all.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/contact-form.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.ajaxchimp.min.js"></script>        
        <!--[if lt IE 10]><script type="text/javascript" src="{{ url('') }}/rythm/js/placeholder.js"></script><![endif]-->
        
    </body>
</html>
