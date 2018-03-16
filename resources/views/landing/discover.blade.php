@extends('layouts/timeline')
 
@section('page-title')
 Discover
@endsection
     
@section('content')       
    <!-- Section -->
    <section class="small-section mt-80 bg-white pb-0 discover-tablist">
        <div class="relative container align-left">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <h1 class="hs-line-11 font-alt mb-20 mb-xs-0">What's popular today</h1>
                    <div class="hs-line-4 font-alt black">
                        See recently added photos with the highest views.
                    </div>
                </div>
            </div>
        </div>
        <div class="relative container align-left mt-50">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#fresh">Fresh</a></li>
                        <li><a href="#popular">Popular</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

    <!-- Section -->
    <section class="page-section pt-20 pb-20">
        <div class="relative">
            <div class="row">
                <div class="col-sm-10 col-sm-push-1">
                  <div class="tab-content">
                      <div role="tabpanel" id="fresh" class="tab-pane fade in active">
                        <ul class="works-grid clearfix font-alt hide-titles masonry" id="fresh-grid" >
                        
                            <!-- Work Item (Lightbox) -->
                            <li class="work-item mix photography" >
                                <a href="rythm/images/portfolio/full-project-1.jpg" class="work-lightbox-link mfp-image">
                                    <div class="work-img">
                                        <img src="rythm/images/portfolio/masonry/projects-7.jpg" alt="Work">
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
                            <li class="work-item mix branding design" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/masonry/projects-2.jpg" alt="Work">
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
                            <li class="work-item mix branding" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/projects-3.jpg" alt="Work">
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
                            <li class="work-item mix design photography" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/projects-4.jpg" alt="Work">
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
                            <li class="work-item mix design" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/projects-5.jpg" alt="Work">
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
                            
                            <!-- Work Item (External Page) -->
                            <li class="work-item mix design photography" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/masonry/projects-6.jpg" alt="Work">
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
                            <li class="work-item mix design" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/projects-7.jpg" alt="Work">
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
                            
                            <!-- Work Item (External Page) -->
                            <li class="work-item mix branding photography" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/projects-10.jpg" alt="Work">
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
                            
                            <!-- Work Item (Lightbox) -->
                            <li class="work-item mix design branding" >
                                <a href="rythm/images/portfolio/full-project-3.jpg" class="work-lightbox-link mfp-image">
                                    <div class="work-img">
                                        <img src="rythm/images/portfolio/projects-8.jpg" alt="Work">
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
                      </div>
                      <div role="tabpanel" id="popular" class="tab-pane fade">
                        <ul class="works-grid clearfix font-alt hide-titles masonry" id="popular-grid" >
                        
                            <!-- Work Item (Lightbox) -->
                            <li class="work-item mix photography" >
                                <a href="rythm/images/portfolio/full-project-1.jpg" class="work-lightbox-link mfp-image">
                                    <div class="work-img">
                                        <img src="rythm/images/portfolio/masonry/projects-7.jpg" alt="Work">
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
                            <li class="work-item mix branding design" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/masonry/projects-2.jpg" alt="Work">
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
                            <li class="work-item mix branding" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/projects-3.jpg" alt="Work">
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
                            <li class="work-item mix design photography" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/projects-4.jpg" alt="Work">
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
                            <li class="work-item mix design" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/projects-5.jpg" alt="Work">
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
                            
                            <!-- Work Item (External Page) -->
                            <li class="work-item mix design photography" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/masonry/projects-6.jpg" alt="Work">
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
                            <li class="work-item mix design" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/projects-7.jpg" alt="Work">
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
                            
                            <!-- Work Item (External Page) -->
                            <li class="work-item mix branding photography" >
                                <a href="portfolio-single-1.html" class="work-ext-link">
                                    <div class="work-img">
                                        <img class="work-img" src="rythm/images/portfolio/projects-10.jpg" alt="Work">
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
                            
                            <!-- Work Item (Lightbox) -->
                            <li class="work-item mix design branding" >
                                <a href="rythm/images/portfolio/full-project-3.jpg" class="work-lightbox-link mfp-image">
                                    <div class="work-img">
                                        <img src="rythm/images/portfolio/projects-8.jpg" alt="Work">
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
                      </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
@endsection

@section('footer_script')
    <script type="text/javascript">
        // Select all tabs
        $(function(){
            $('.nav-tabs a').on('click', function(e){
                e.preventDefault();
                $(this).tab('show');
                if($(this).attr('href') == '#fresh'){
                    setTimeout(function(){
                        $('#fresh-grid').masonry();
                    }, 300);
                } else if($(this).attr('href') == '#popular'){
                    setTimeout(function(){
                        $('#popular-grid').masonry();
                    }, 300);
                }
            });
        });
    </script>
@endsection