@extends('layouts/timeline')

@section('page-title')
{{ $user['fullname'] }}
@endsection

@section('header_script')
<link rel="stylesheet" href="{{ url('') }}/css/profiles.css">  
@endsection

@section('content')
<!-- Section -->
<section class="small-section mt-80 bg-white pb-0 pt-0 profile-header">
    <div class="relative mb-30 mt-30">
        <div class="row">
            <div class="col-sm-12 align-center">
                @if($user['_id'] == \App\Models\User::current()['_id'])
                <div class="text-right profile-button">
                    <a  href="{{ url('manage/all') }}" class="btn btn-default">Manage</a>
                    <a href="{{ url('user/edit') }}" class="btn btn-primary">Edit Profile</a>
                </div>
                @else
                <div class="profile-follow">
                    @if(\App\Models\User::isFollower($user['_id']))
                    <a class="btn btn-follow followed follow-{{ $user['_id'] }}" data-userid="{{ $user['_id'] }}" data-action="{{ url('user/relation') }}">Followed</a>
                    @else
                    <a class="btn btn-follow follow-{{ $user['_id'] }}" data-userid="{{ $user['_id'] }}" data-action="{{ url('user/relation') }}">Follow</a>
                    @endif
                </div>
                @endif

                <div class="profile-avatar">
                    @if (!empty($user['photo']))
                        <img src="{{ url($user['photo']) }}" />
                    @else
                        <img src="{{ url('') }}/images/pp-icon.png" />
                    @endif
                </div>
            </div>
        </div>

    </div>
    <div class="relative container mb-20">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="align-center mt-0 mb-10">{{ $user['fullname'] }}</h1>
                <ul class="details align-center mb-0">
                    <li><span>{{ $user->view_count }}</span> Photo Views</li>
                    <li><span>{{ $user->getFollowerCount() }}</span> Followers</li>
                    <li><span>{{ $user->getFollowingCount() }}</span> Following</li>
                </ul>
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

<section class="page-section pt-20">
    <div class="relative">
        <div class="col-xs-12">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="photos">
                    <ul class="works-grid work-grid-3 work-grid-gut clearfix font-alt hide-titles profile-grid" id="work-grid">
                        @foreach($medias as $media)
                        <!-- Work Item (External Page) -->
                        <li class="work-item">
                            <div data-postid="{{ $media->_id }}" class="work-item-inner work-ext-link open-single-post">
                                <div class="work-img">
                                    <img class="work-img" src="{{ url('').'/'.$media->images['medium'] }}" alt="Work" />
                                </div>
                                <div class="work-intro">
                                    <div class="work-pp">
                                        <img src="{{ url($media->user['photo']) }}">
                                    </div>
                                    <h3 class="work-title">{{ $media->title }}</h3>
                                    <a data-postid="{{ $media->_id }}" class="like-button like-mini-{{ $media->_id }} {{ $media->isLiked($current_user_id) ? 'liked' : '' }}"><i class="fa fa-heart-o"></i></a>
                                </div>
                            </div>
                        </li>
                        <!-- End Work Item -->
                        @endforeach
                    </ul>
                </div>
            </div>   
        </div>
    </div>
</section>

@include('partials/post-modal')

@endsection

@section('footer_script')
<script type="text/javascript">
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

