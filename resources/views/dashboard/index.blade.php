@extends('layouts/timeline')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')   
<section class="page-section pt-100">
    <div class="container relative">
        <div class="col-xs-12 col-md-6 col-md-push-3 post-wrapper">
            @if(count(\App\Models\User::getFollowing()))
                <?php $is_popular = false; ?>
                <div class="row" id="post-data">
                    @include('dashboard/single-post')
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