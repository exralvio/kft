@extends('layouts/global')

@section('page-title')
{{ $user['fullname'] }}
@endsection

@section('header_script')
<link rel="stylesheet" href="{{ url('') }}/css/profiles.css">  
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/justifiedGallery.min.css">
@endsection

@section('content')
<!-- Section -->
<section class="small-section mt-80 bg-white pb-0 pt-0 profile-header">
    <div class="relative mb-10 mt-30">
        <div class="row">
            <div class="col-sm-12 align-center">
                

                <div class="profile-avatar">
                    @if (!empty($user['photo']))
                        <img src="{{ url($user['photo']) }}" />
                    @else
                        <img src="{{ url('') }}/images/pp-icon.png" />
                    @endif
                </div>

                @if($current_user_id != $user['_id'])
                <div class="profile-follow mt-10">
                    @if(\App\Models\User::isFollower($user['_id']))
                    <a class="btn btn-follow followed follow-{{ $user['_id'] }}" data-userid="{{ $user['_id'] }}" data-action="{{ url('user/relation') }}">Followed</a>
                    @else
                    <a class="btn btn-follow follow-{{ $user['_id'] }}" data-userid="{{ $user['_id'] }}" data-action="{{ url('user/relation') }}">Follow</a>
                    @endif
                </div>
                @endif

                @if(\Auth::check() and $current_user_id == $user['_id'])
                <div class="profile-button mt-10">
                    <a  href="{{ url('manage/all') }}" class="btn btn-default">Manage Photo</a>
                    <a href="{{ url('user/edit') }}" class="btn btn-primary">Edit Profile</a>
                </div>
                @endif
            </div>
        </div>

    </div>
    <div class="relative container mb-20">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="align-center mt-0 mb-10">{{ $user['fullname'] }}</h1>
            </div>
        </div>
        <div class="row">
            @if(!empty($user->about))
            <div class="col-xs-12 col-md-6 col-md-push-3 align-center">
                {!! nl2br($user->about) !!}
            </div>
            @endif
            <div class="col-xs-12">
                <ul class="details align-center mb-0">
                    <li><span>{{ $user->view_count }}</span> Photo Views</li>
                    <li>
                        <a class="open-followers">
                            <span>{{ $user->getFollowerCount() }}</span> Followers
                        </a>
                    </li>
                    <li>
                        <a class="open-followings">
                            <span>{{ $user->getFollowingCount() }}</span> Following
                        </a>
                    </li>
                </ul>
                <input id="follow-userId" type="hidden" value="{{ $user['_id'] }}">
            </div>
        </div>
    </div>
    <div class="relative profile-tabs pt-10">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-md-push-4 align-center profile-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#photos" role="tab" data-toggle="tab">{{ $user->getMediaCount() }} Photos</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- End Section -->

<section class="page-section pt-20 pb-20">
    <div class="relative">
        <div class="col-xs-12">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active tab-grid" id="photos">
                    <div id="gallery-grid" class="photo-grid">
                        @foreach($medias as $media)
                        <a href="{{ url('/media/'.$media['_id']) }}" data-postid="{{ $media->_id }}" class="open-single-post photo-grid-item">
                            <img src="{{ url('').'/'.$media->images['medium'] }}" class="photo-grid-img" />

                            <div class="photo-grid-desc">
                                <span>
                                    {{ $media->title }}
                                </span>

                                @if(!$media->isSelfBelong($current_user_id))
                                <button data-postid="{{ $media->_id }}" class="like-button like-mini-{{ $media->_id }} {{ $media->isLiked($current_user_id) ? 'liked' : '' }}"><i class="fa fa-heart-o"></i></button>
                                @endif
                            </div>
                            
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>   
        </div>
    </div>
</section>

@include('partials/post-modal')
@include('partials/follow-modal')

@endsection

@section('footer_script')
<script type="text/javascript" src="{{ url('/') }}/js/jquery.justifiedGallery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $("#gallery-grid").justifiedGallery({
            rowHeight: 256,
            margins: 10
        });
    });

    window.addEventListener("load", function(){
        $(document).ready(function() {
            var photo = "<?php echo $user->photo; ?>";
            var photoUrl = "";
            if(photo.length){
                photoUrl = "../"+photo;
            }else{
                photoUrl = "../images/pp-icon.png";
            }
            $('#pp-preview').css({'background':"url("+photoUrl+")","background-size":"contain"});
            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#pp-preview"
            });
        });
    });
</script>
@endsection

