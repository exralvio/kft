@extends('layouts/global')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')   
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
                <a href="#discover" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i></a>
            </div>
            <!-- End Scroll Down -->
            
        </div>
    </section>
    <!-- End Home Section -->

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
@endsection