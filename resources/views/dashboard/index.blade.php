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
                    <div class="item active">
                      <img src="{{ url('uploads/announcement/stockholm.jpg') }}" alt="...">
                      <h3 class="carousel-title">
                          Ini adalah title blablasdfbl
                      </h3>
                      <div class="carousel-caption">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                      </div>
                    </div>
                    <div class="item">
                      <img src="{{ url('uploads/announcement/stockholm.jpg') }}" alt="...">
                      <h3 class="carousel-title">
                          Ini adalah title blablasdfbl
                      </h3>
                      <div class="carousel-caption">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                      </div>
                    </div>
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