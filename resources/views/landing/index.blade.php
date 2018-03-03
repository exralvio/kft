<!DOCTYPE html>
<html>
    <head>
        <title>KFT | Komunitas Fotografi Telkom</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta charset="utf-8">
        <meta name="author" content="Roman Kirichik">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        
        <!-- Favicons -->
        <link rel="shortcut icon" href="{{ url('') }}/rythm/images/favicon.png">
        <link rel="apple-touch-icon" href="{{ url('') }}/rythm/images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ url('') }}/rythm/images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ url('') }}/rythm/images/apple-touch-icon-114x114.png">
        
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
            
            <!-- Home Section -->
            <section class="home-section bg-dark-alfa-30 parallax-2" data-background="{{ url('') }}/rythm/images/landing/cover.jpg" id="home">
                <div class="js-height-full">
                    
                    <!-- Hero Content -->
                    <div class="home-content">
                        <div class="home-text">
                            
                            <h1 class="hs-line-1 font-alt mb-80 mb-xs-30 mt-70 mt-sm-0">
                                Komunitas Fotografi Telkom
                            </h1>
                            
                            <div class="hs-line-6">
                                Get inspired and share your best photos
                            </div>
                            
                        </div>
                    </div>
                    <!-- End Hero Content -->
                    
                    <!-- Scroll Down -->
                    <div class="local-scroll">
                        <a href="#about" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i></a>
                    </div>
                    <!-- End Scroll Down -->
                    
                </div>
            </section>
            <!-- End Home Section -->
            
            <!-- Navigation panel -->
            <nav class="main-nav transparent stick-fixed">
                <div class="full-wrapper relative clearfix">
                    <!-- Logo ( * your text or image into link tag *) -->
                    <div class="nav-logo-wrap local-scroll">
                        <a href="#top" class="logo">
                            <img src="{{ url('') }}/rythm/images/logo-white.png" alt="" />
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
                            <li><a href="#about">Login</a></li>
                            <li><a href="#services" class="nav-signup">Sign up</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navigation panel -->
            
            
            <!-- Portfolio Section -->
            <section class="page-section pb-0" id="discover">
                <div class="relative">
                    
                    <h2 class="section-title font-alt mb-70 mb-sm-40">
                        Discover
                    </h2>
                    
                    <!-- Works Filter -->                    
                    <div class="works-filter font-alt align-center">
                        <a href="#" class="filter active" data-filter="*">All works</a>
                        <a href="#branding" class="filter" data-filter=".branding">Branding</a>
                        <a href="#design" class="filter" data-filter=".design">Design</a>
                        <a href="#photography" class="filter" data-filter=".photography">Photography</a>
                    </div>                    
                    <!-- End Works Filter -->
                    
                    <!-- Works Grid -->
                    <ul class="works-grid work-grid-3 work-grid-gut clearfix font-alt hover-white hide-titles" id="work-grid">
                        
                        <!-- Work Item (Lightbox) -->
                        <li class="work-item mix photography">
                            <a href="{{ url('') }}/rythm/images/portfolio/full-project-1.jpg" class="work-lightbox-link mfp-image">
                                <div class="work-img">
                                    <img src="{{ url('') }}/rythm/images/portfolio/projects-1.jpg" alt="Work" />
                                </div>
                                <div class="work-intro">
                                    <h3 class="work-title">Portrait</h3>
                                    <div class="work-descr">
                                        Lightbox 
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- End Work Item -->
                        
                        <!-- Work Item (External Page) -->
                        <li class="work-item mix branding design">
                            <a href="portfolio-single-1.html" class="work-ext-link">
                                <div class="work-img">
                                    <img class="work-img" src="{{ url('') }}/rythm/images/portfolio/projects-2.jpg" alt="Work" />
                                </div>
                                <div class="work-intro">
                                    <h3 class="work-title">Vase 3D</h3>
                                    <div class="work-descr">
                                        External Page
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- End Work Item -->
                        
                        <!-- Work Item (External Page) -->
                        <li class="work-item mix branding">
                            <a href="portfolio-single-1.html" class="work-ext-link">
                                <div class="work-img">
                                    <img class="work-img" src="{{ url('') }}/rythm/images/portfolio/projects-3.jpg" alt="Work" />
                                </div>
                                <div class="work-intro">
                                    <h3 class="work-title">Boy in T-shirt</h3>
                                    <div class="work-descr">
                                        External Page
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- End Work Item -->
                        
                        <!-- Work Item (External Page) -->
                        <li class="work-item mix design photography">
                            <a href="portfolio-single-1.html" class="work-ext-link">
                                <div class="work-img">
                                    <img class="work-img" src="{{ url('') }}/rythm/images/portfolio/projects-4.jpg" alt="Work" />
                                </div>
                                <div class="work-intro">
                                    <h3 class="work-title">Space</h3>
                                    <div class="work-descr">
                                        External Page
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- End Work Item -->
                        
                        <!-- Work Item (External Page) -->
                        <li class="work-item mix design">
                            <a href="portfolio-single-1.html" class="work-ext-link">
                                <div class="work-img">
                                    <img class="work-img" src="{{ url('') }}/rythm/images/portfolio/projects-5.jpg" alt="Work" />
                                </div>
                                <div class="work-intro">
                                    <h3 class="work-title">Model</h3>
                                    <div class="work-descr">
                                        External Page
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- End Work Item -->
                        
                        <!-- Work Item (Lightbox) -->
                        <li class="work-item mix design branding">
                            <a href="{{ url('') }}/rythm/images/portfolio/full-project-3.jpg" class="work-lightbox-link mfp-image">
                                <div class="work-img">
                                    <img src="{{ url('') }}/rythm/images/portfolio/projects-6.jpg" alt="Work" />
                                </div>
                                <div class="work-intro">
                                    <h3 class="work-title">Young Man</h3>
                                    <div class="work-descr">
                                        Lightbox
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- End Work Item -->
                        
                    </ul>
                    <!-- End Works Grid -->
                    
                </div>
            </section>
            <!-- End Portfolio Section -->
            
            <!-- Foter -->
            <footer class="page-section bg-gray-lighter footer">
                <div class="container">
                    
                   
                    
                    <!-- Footer Text -->
                    <div class="footer-text">
                        
                        <!-- Copyright -->
                        <div class="footer-copy font-alt">
                            <a href="http://themeforest.net/user/theme-guru/portfolio" target="_blank">&copy; Komunitas Fotografi Telkom 2018</a>.
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
        <!-- Replace test API Key "AIzaSyAZsDkJFLS0b59q7cmW0EprwfcfUA8d9dg" with your own one below 
        **** You can get API Key here - https://developers.google.com/maps/documentation/javascript/get-api-key -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZsDkJFLS0b59q7cmW0EprwfcfUA8d9dg"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/wow.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/masonry.pkgd.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.simple-text-rotator.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/all.js"></script>       
        <!--[if lt IE 10]><script type="text/javascript" src="{{ url('') }}/rythm/js/placeholder.js"></script><![endif]-->
        
    </body>
</html>
