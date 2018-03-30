@extends('layouts/timeline')

@section('page-title')
{{ $user['fullname'] }}
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('') }}/css/profiles.css">  
<link rel="stylesheet" href="{{ url('') }}/css/photo-detail.css">  
<section class="page-section pt-80" id="profile">
    <div class="row">
        <div class="col-sm-12">
            <div class="pp-container pt-20">
                <div class="pp-image">
                    @if (isset($user['photo']))
                        <img src="{{ url('').'/'.$user->photo }}"/>
                    @else
                        <img src="{{ url('') }}/images/pp-icon.png"/>
                    @endif
                </div>
            </div>
            @if($user['_id'] == \App\Models\User::current()['_id'])
            <div class="text-right profile-button">
                <a  href="{{ url('manage/all') }}" class="btn btn-default">Manage</a>
                <a href="" class="btn btn-primary btn-open-setting">Edit Profile</a>
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
        </div>
    </div>
    <div class="text-center user-profile">
        <div class="profile-name">{{ $user->firstname }} {{ $user->lastname }}</div>
        <div class="profile-social">
            <ul>
                <li>{{ $user->photoview_number ? $user->photoview_number : 0 }} Photos Views</li>
                <li>{{ $user->getFollowerCount() }} Followers</li>
                <li>{{ $user->getFollowingCount() }} Following</li>
            </ul>
        </div>
    </div>
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">PHOTOS</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="photos">
                <!-- Works Grid -->
                <ul id="post-data" class="works-grid work-grid-3 work-grid-gut clearfix font-alt hover-white hide-titles" style="margin: 5px;">
                    
                    @foreach($medias as $media)
                    <!-- Work Item (External Page) -->
                    <li class="media-list work-item">
                        <a id="{{ $media->_id }}" href="#" class="comment-button work-ext-link">
                            <div class="work-img">
                                <img class="work-img" src="{{ url('').'/'.$media->images['medium'] }}" alt="Work" />
                            </div>
                            <div class="work-intro">
                                <h3 class="work-title">{{ $media->title }}</h3>
                            </div>
                        </a>
                    </li>
                    <!-- End Work Item -->
                    @endforeach
                    
                </ul>
                <!-- End Works Grid -->
            </div>
        </div>
    </div>
</section>

<div class="modal-fs" id="commentPost" data-remodal-id="commentPostModal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div id="comment-content"></div>
</div>
@endsection

@section('footer_script')
<script type="text/javascript" src="{{ url('') }}/js/dashboard.js"></script>
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

