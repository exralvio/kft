@extends('layouts/landing')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('header_script')
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/justifiedGallery.min.css">
@endsection

@section('content')   
    <!-- Home Section -->
    <?php $cover = App\Models\Setting::valueOf('cover_landing'); ?>
    <section class="home-section bg-dark-alfa-30 parallax-2" data-background="{{ !empty($cover) ? url($cover) : url('rythm/images/landing/cover.jpg') }}" id="home">
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
                        <div id="popular-grid" class="photo-grid">
                            <?php $medias = $media_popular; ?>
                            @include('media/discover-popular')
                        </div>
                      </div>
                      <div role="tabpanel" id="fresh" class="tab-pane fade ">
                        <div id="fresh-grid" class="photo-grid" style="opacity:0;">
                            <?php $medias = $media_fresh; ?>
                            @include('media/discover-fresh')
                        </div>
                      </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

    @include('partials/post-modal')
@endsection

@section('footer_script')
<script type="text/javascript" src="{{ url('/') }}/js/jquery.justifiedGallery.min.js"></script>
<script type="text/javascript">
    // Select all tabs
    $(function(){
        var fresh_done = false;
        $('.nav-tabs a').on('click', function(e){
            e.preventDefault();
            $(this).tab('show');

            if($(this).attr('href') == '#fresh' || !fresh_done){
                setTimeout(function(){
                    $("#fresh-grid").justifiedGallery({
                        rowHeight: 256,
                        margins: 10
                    });

                    $('#fresh-grid').css('opacity', 1);
                }, 500);

                fresh_done = true;
            }
        });

        
        $("#popular-grid").justifiedGallery({
            rowHeight: 256,
            margins: 10
        });
        
    });
</script>
@endsection