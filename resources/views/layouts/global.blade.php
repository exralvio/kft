<!DOCTYPE html>
<html>
    <head>
        <title>KFT | @yield('page-title')</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta charset="utf-8">
        <meta name="author" content="Roman Kirichik">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="google-signin-client_id" content="859547891790-3i4v7ltdrgmp35c7kcitth2fadqgvmiq.apps.googleusercontent.com">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
        <!-- Favicons -->
        <link rel="shortcut icon" href="{{ url('') }}/images/favicon.ico">
        <link rel="apple-touch-icon" href="{{ url('') }}/rythm/images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ url('') }}/rythm/images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ url('') }}/rythm/images/apple-touch-icon-114x114.png">
        
        <!-- CSS -->
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/style.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/style-responsive.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/animate.min.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/vertical-rhythm.min.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/owl.carousel.css">
        <link rel="stylesheet" href="{{ url('') }}/rythm/css/magnific-popup.css">
        <link rel="stylesheet" type="text/css" href="{{ url('') }}/css/remodal.css">
        <link rel="stylesheet" type="text/css" href="{{ url('') }}/css/remodal-default-theme.css">
        <link rel="stylesheet" href="{{ url('') }}/bootstrap-social/bootstrap-social.css">
        <link rel="stylesheet" href="{{ url('') }}/css/bootstrap-carousel.css">

        <link rel="stylesheet" href="{{ url('') }}/css/nav.css">
        <link rel="stylesheet" href="{{ url('') }}/css/custom.css">
        <link rel="stylesheet" href="{{ url('') }}/css/media.css">   
        @yield('header_script')

    </head>
    <body class="appear-animate timeline">
        <!-- <script type="text/javascript" src="{{ url('') }}/js/fb-script.js"></script> -->
        <!-- Page Loader -->        
        <div class="page-loader">
            <div class="loader">Loading...</div>
        </div>
        <!-- End Page Loader -->
        
        <!-- Page Wrap -->
        <div class="page" id="top">
            
            <!-- Begin Navigation -->
            @include('layouts/nav')
            <!-- End Navigation -->

            <!-- Begin Content -->
            @yield('content')
            <!-- End Content -->
        
        </div>
        <!-- End Page Wrap -->
        

        <!-- JS -->
        <script type="text/javascript" src="{{ url('') }}/js/jquery-1.12.4.min.js"></script>
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
        <script type="text/javascript" src="{{ url('') }}/js/jquery.uploadPreview.js"></script>
        <script type="text/javascript" src="{{ url('') }}/js/bootstrap-carousel.min.js"></script>

        
        <script type="text/javascript" src="{{ url('') }}/rythm/js/wow.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/masonry.pkgd.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/jquery.simple-text-rotator.min.js"></script>
        <script type="text/javascript" src="{{ url('') }}/rythm/js/all.js"></script>
        <script type="text/javascript" src="{{ url('') }}/js/remodal.min.js"></script>       
        <script type="text/javascript" src="{{ url('') }}/js/nav.js"></script>
        <script type="text/javascript" src="{{ url('') }}/js/media.js"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <!--[if lt IE 10]><script type="text/javascript" src="{{ url('') }}/rythm/js/placeholder.js"></script><![endif]-->
        </script>
        
        @include('partials/uploader')
        @include('partials/relation')

        @if(\Auth::check())
        <script type="text/javascript">
            checkUnreadNotification();
        </script>
        @endif

        @yield('footer_script')
        
        <script>
            function fbs_click(e){
                u = $(e).attr('share-url');
                t = $(e).attr('share-title');
                width = 626;
                height = 436;
                left = ($(window).width()  - width)  / 2;
                top = ($(window).height() - height) / 2;
                toolbar = 0;
                status = 0;
                opts   = ',width='  + width  +
                        ',height=' + height +
                        ',top='    + top    +
                        ',left='   + left;

                // console.log(u,t);
                window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer',opts);
                return false;
                e.preventDefault();
            }

            function twt_click(e){
                var width  = 575,
                    height = 400,
                    left   = ($(window).width()  - width)  / 2,
                    top    = ($(window).height() - height) / 2,
                    url    = "http://twitter.com/share?url="+$(e).attr('share-url'),
                    opts   = 'status=1' +
                            ',width='  + width  +
                            ',height=' + height +
                            ',top='    + top    +
                            ',left='   + left;
                
                window.open(url, 'twitter', opts);
                return false;
                e.preventDefault();
            }

        </script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119683014-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-119683014-1');
        </script>

    </body>
</html>
