@extends('layouts/global')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')   
<section class="page-section pt-100">
    <div class="container relative">
        <div class="row mb-30">
            <div class="col-xs-12 col-md-10 col-md-push-1">
                <div id="announcement" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#announcement" data-slide-to="0" class="active"></li>
                    <li data-target="#announcement" data-slide-to="1"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    @foreach(App\Models\Announcement::all() as $key=>$announcement)
                      <div class="item {{ $key == 0 ? 'active' : '' }}" >
                        <img src="{{ url($announcement->background) }}" alt="...">

                        <div class="carousel-overlay"></div>
                        
                        <div class="carousel-caption">
                          <h3>
                              {{ $announcement['title'] }}
                          </h3>
                          @if(!empty($announcement['description']))
                            {{ $announcement['description'] }}
                          @endif

                          @if(!empty($announcement['button']))
                            <a href="{{ $announcement['link'] }}" target="_blank" class="btn btn-mod btn-circle mt-20">{{ $announcement['button'] }}</a>
                          @endif
                        </div>

                        @if(!empty($announcement['credit_name']))
                        <div class="carousel-credit">
                          Photo By <a href="{{ $announcement['credit_link'] }}" target="_blank">{{ $announcement['credit_name'] }}</a>
                        </div>
                        @endif
                      </div>
                    @endforeach
                  </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-10 col-md-push-1 post-wrapper">
            @if(count(\App\Models\User::getFollowing()))
                <?php $is_popular = false; ?>
                <div class="row" id="post-data">
                    @include('dashboard/each-post')
                </div>
            @else
                <div class="row bg-white popular-alert mb-20">
                    <div class="col-xs-12">
                        <h2 class="mb-10"><i class="fa fa-lg fa-exclamation-triangle"></i> Now you're seeing popular post!</h2>
                        <p>Follow someone to acquire your own feeds.</p>
                    </div>
                </div>
                
                <?php $is_popular = true; ?>
                <div class="row" id="popular-media">
                    @foreach($popularMedias as $post)
                        @include('partials/single-post')
                    @endforeach
                </div>
            @endif
            
            <!-- Ajax Loader -->
            <div class="text-center ajax-load"  style="display:none">
                <p><img src="{{url('images/ajax-loader.gif')}}">Loading More post</p>
            </div>

        </div>
    </div>
</section>

@include('partials/post-modal')
@endsection