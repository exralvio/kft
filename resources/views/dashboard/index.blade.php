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

            <div class="row" id="popular-media">
                @foreach($popularMedias as $post)
                <div class="timeline-post mb-xs-30 wow fadeInUp" id="{{ $post->_id }}">
                    <div>
                
                        <div class="post-header">
                            <div class="poster-pp">
                                <img src="{{ isset($post->user['photo']) ? $post->user['photo'] : url('images/pp-icon.png') }}"/>
                            </div>
                            <div class="post-container font-alt">
                                <div class="poster">{{ $post->user['firstname'] }} {{ isset($post->user['lastname']) ? $post->user['lastname'] : '' }}</div>
                                <div class="publish-date">{{ $post->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                            
                        <div class="team-item-image">
                            <img src="{{ $post->images['medium'] }}" alt="{{ $post->title }}" />
                        </div>
                
                        <div class="row post-footer">
                            <div class="col-md-6 font-alt post-title">{{ $post->title }}</div>
                            <div class="col-md-6 text-right" style="margin-top: 5px;">
                                <a id="{{ $post->_id }}" class="button-rounded comment-button" href="#">
                                    <i class="fa fa-comment-o"></i>
                                </a>
                                <a class="button-rounded">
                                    <i class="fa fa-plus-square-o"></i> 
                                </a>
                                @if($post->liked)
                                <a data-postid="{{ $post->_id }}" class="like-{{ $post->_id }} like-button button-rounded liked-bg">
                                    <i class="fa fa-heart-o"></i> 
                                    <span id="like-count-{{ $post->_id }}">{{ count($post->like_users) }}</span>
                                </a>
                                @else
                                <a data-postid="{{ $post->_id }}" class="like-{{ $post->_id }} like-button button-rounded blue-sky-bg">
                                        <i class="fa fa-heart-o"></i> 
                                        <span id="like-count-{{ $post->_id }}">{{ count($post->like_users) }}</span>
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-12 post-description">{{ $post->description }}</div>
                        </div>
                        
                    </div>
                </div>
                @endforeach
            </div>

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

