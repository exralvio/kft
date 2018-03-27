@extends('layouts/timeline')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')   
<link rel="stylesheet" href="{{ url('') }}/css/dashboard.css">  
<link rel="stylesheet" href="{{ url('') }}/css/photo-detail.css">  
<section class="page-section pt-100">
    <div class="container relative">
        <div class="col-xs-12 col-lg-10 col-lg-push-1 post-wrapper">

            <div class="row" id="post-data">
                @include('dashboard/single-post')
            </div>

            <!-- Ajax Loader -->
            <div class="text-center ajax-load"  style="display:none">
                <p><img src="{{url('images/ajax-loader.gif')}}">Loading More post</p>
            </div>

        </div>
    </div>
</section>
<div class="modal-fs" id="commentPost" data-remodal-id="commentPostModal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div id="comment-content"></div>
</div>

<script type="text/javascript" src="{{ url('') }}/js/dashboard.js"></script>
@endsection

