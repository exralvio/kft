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
                    
                    <h1 class="hs-line-2 mb-20 mb-xs-10 mt-70 mt-sm-0 landing-text-1">
                        Get inspired and share your best photos
                    </h1>
                    
                    <div class="hs-line-3 landing-text-2">
                        Find your home among the world's best photographers.
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

    <!-- Section -->
    <section class="page-section pb-0 discover-tablist dashboard-tablist" id="discover">
        <div class="relative container">
            <div class="row">
                <div class="col-xs-12 align-center">
                    <h1 class="hs-line-15 font-alt mb-20 mb-xs-0">The top photos, chosen by you</h1>
                    <div class="hs-line-4 font-alt black">
                        Discover what’s trending according to photographers around the world.
                    </div>
                </div>
            </div>
        </div>
        <div class="relative container align-left mt-50">
            <div class="row">
                <div class="col-xs-12 align-center">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#popular">Popular</a></li>
                        <li ><a href="#fresh">Fresh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section pt-20 pb-20">
        <div class="relative">
            <div class="">
                <div class="col-sm-12">
                  <div id="post-data" class="tab-content discover-grid dashboard-grid">
                      <div role="tabpanel" id="popular" class="tab-pane fade in active">
                        <ul class="works-grid work-grid-2 work-grid-gut  clearfix font-alt hide-titles" id="popular-grid" >
                            @foreach(\App\Models\Media::discoverPopular(4) as $popular)
                            <!-- Work Item (Lightbox) -->
                            <li class="work-item" >
                                <div data-postid="{{ $popular['media']['id'] }}" class="work-item-inner open-single-post">
                                    <div class="work-img">
                                        <img src="{{ url($popular['images']['medium']) }}" alt="Work">
                                    </div>
                                    <div class="work-intro align-left">
                                        <div class="work-pp">
                                            <img src="{{ url($popular->user['photo']) }}">
                                        </div>
                                        <h3 class="work-title">{{ $popular['user']['fullname'] }}</h3>
                                        <a data-postid="{{ $popular->media['id'] }}" class="like-button like-mini-{{ $popular->media['id'] }}"><i class="fa fa-heart-o"></i></a>
                                    </div>
                                </div>
                            </li>
                            <!-- End Work Item -->
                            @endforeach
                        </ul>
                      </div>
                      <div role="tabpanel" id="fresh" class="tab-pane fade ">
                        <ul class="works-grid work-grid-2 work-grid-gut clearfix font-alt hide-titles" id="fresh-grid" >
                            @foreach(\App\Models\Media::discoverFresh(4) as $media)
                            <!-- Work Item (Lightbox) -->
                            <li class="work-item" >
                                <div data-postid="{{ $media->_id }}" class="work-item-inner open-single-post">
                                    <div class="work-img">
                                        <img src="{{ url($media['images']['medium']) }}" alt="Work">
                                    </div>
                                    <div class="work-intro">
                                        <div class="work-pp">
                                            <img src="{{ url($media->user['photo']) }}">
                                        </div>
                                        <h3 class="work-title">{{ $media['user']['fullname'] }}</h3>
                                        <a data-postid="{{ $media->_id }}" class="like-button like-mini-{{ $media->_id }}"><i class="fa fa-heart-o"></i></a>
                                    </div>
                                </a>
                            </li>
                            <!-- End Work Item -->
                            @endforeach
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
        });
    });
</script>
@endsection