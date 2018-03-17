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
                    <h1 class="hs-line-11 font-alt mb-20 mb-xs-0 discover-text1">What's popular today</h1>
                    <div class="hs-line-4 font-alt black discover-text2">
                        See recently added photos with the highest views.
                    </div>
                </div>
            </div>
        </div>
        <div class="relative container align-left mt-50">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#popular">Popular</a></li>
                        <li ><a href="#fresh">Fresh</a></li>
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
                      <div role="tabpanel" id="popular" class="tab-pane fade in active">
                        <ul class="works-grid work-grid-gut  clearfix font-alt hide-titles masonry" id="popular-grid" >
                            @foreach(\App\Models\Media::popularMedia() as $media)
                            <!-- Work Item (Lightbox) -->
                            <li class="work-item mix photography" >
                                <a href="{{ url($media['images']['large']) }}" class="work-lightbox-link mfp-image">
                                    <div class="work-img">
                                        <img src="{{ url($media['images']['medium']) }}" alt="Work">
                                    </div>
                                </a>
                                    <div class="work-intro align-left">
                                        <div class="profile-icon"><img src="{{ $media['user']['photo'] }}"></div>
                                        <h3 class="work-title">{{ $media->getName() }}</h3>
                                    </div>
                            </li>
                            <!-- End Work Item -->
                            @endforeach
                        </ul>
                      </div>
                      <div role="tabpanel" id="fresh" class="tab-pane fade ">
                        <ul class="works-grid work-grid-gut clearfix font-alt hide-titles masonry" id="fresh-grid" >
                            @foreach(\App\Models\Media::freshMedia() as $media)
                            <!-- Work Item (Lightbox) -->
                            <li class="work-item mix photography" >
                                <a href="{{ url($media['images']['large']) }}" class="work-lightbox-link mfp-image">
                                    <div class="work-img">
                                        <img src="{{ url($media['images']['medium']) }}" alt="Work">
                                    </div>
                                </a>
                                    <div class="work-intro align-left">
                                        <div class="profile-icon"><img src="{{ $media['user']['photo'] }}"></div>
                                        <h3 class="work-title">{{ $media->getName() }}</h3>
                                    </div>
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
                if($(this).attr('href') == '#fresh'){
                    $('.discover-text1').text("The newest uploads");
                    $('.discover-text2').text("Be one of the first to discover the photos just added to 500px.");
                    setTimeout(function(){
                        $('#fresh-grid').masonry();
                    }, 300);
                } else if($(this).attr('href') == '#popular'){
                    $('.discover-text1').text("What's popular today");
                    $('.discover-text2').text("See recently added photos with the highest views.");
                    setTimeout(function(){
                        $('#popular-grid').masonry();
                    }, 300);
                }
            });
        });
    </script>
@endsection