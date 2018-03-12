@extends('layouts/timeline')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')
<section class="page-section pt-70" id="profile">
    <div class="text-center user-profile">
        <div class="profile-name">Fazrin Mutaqin</div>
        <div class="profile-social">
            <ul>
                <li>0 Affection</li>
                <li>0 Photos Views</li>
                <li>0 Followers</li>
                <li>0 Following</li>
                <li class="location-icon">Bandung, Indonesia</li>
            </ul>
        </div>
    </div>
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">PHOTOS</a></li>
            <li role="presentation"><a href="#galleries" aria-controls="galleries" role="tab" data-toggle="tab">GALLERIES</a></li>
            <li role="presentation"><a href="#groups" aria-controls="groups" role="tab" data-toggle="tab">GROUPS</a></li>
            <li role="presentation"><a href="#about" aria-controls="about" role="tab" data-toggle="tab">ABOUT</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="photos">
                <!-- Works Grid -->
                <ul class="works-grid work-grid-3 work-grid-gut clearfix font-alt hover-white hide-titles" id="work-grid-1">
                    
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
            <div role="tabpanel" class="tab-pane fade" id="galleries">
                <!-- Works Grid -->
                <ul class="works-grid work-grid-3 work-grid-gut clearfix font-alt hover-white hide-titles" id="work-grid-2">
                    
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
            <div role="tabpanel" class="tab-pane fade" id="groups">Groups</div>
            <div role="tabpanel" class="tab-pane fade" id="about">About</div>
        </div>
    </div>
</section>
@endsection