<div class="row">
    <input id="postId" type="hidden" value="{{ $post->_id }}">
    <div class="col-xs-12 col-md-9">
        <div class="media-photo text-center">
            <img src="{{ url($post['images']['large']) }}">
        </div>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="post-details">
            <div class="row comment-user-block">
                <div class="mt-20 mb-10">
                    <div class="pp">
                        <img src="{{ url($post->user['photo']) }}">
                    </div>
                    <div class="comment-profile-name">
                        <a class="profile-link" href="{{ url('profile/'.$post->user['id']) }}">{{ $post->user['fullname'] }}</a>
                    </div>    

                    @if(\Auth::check() and $post->user['id'] != \App\Models\User::current()['_id'])
                    <div class="comment-profile-follow">
                        @if(\App\Models\User::isFollower($post->user['id']))
                        <a class="btn btn-sm btn-follow followed follow-{{ $post->user['id'] }}" data-userid="{{ $post->user['id'] }}" data-action="{{ url('user/relation') }}">Followed</a>
                        @else
                        <a class="btn btn-sm btn-follow follow-{{ $post->user['id'] }}" data-userid="{{ $post->user['id'] }}" data-action="{{ url('user/relation') }}">Follow</a>
                        @endif
                    </div>
                    @else
                    <div class="comment-profile-followers">{{ \App\Models\User::followerCount($post->user['id']) }} Followers</div>
                    @endif

                    <div class="clearfix"></div>
                </div>
                
                <div class="post-action mb-20 text-left">
                    <a data-postid="{{ $post->_id }}" class="like-{{ $post->_id }} like-button {{ $post->isLiked($current_user_id) ? 'liked' : '' }} {{ $post->isSelfBelong($current_user_id) ? 'disabled' : '' }}">
                        <i class="fa {{ $post->isLiked($current_user_id) ? 'fa-heart' : 'fa-heart-o' }}"></i> 
                        <span id="like-count-{{ $post->_id }}">{{ $post->like_count }}</span>
                    </a>
                </div>
            </div>
            <div class="row media-photo-detail text-center" style="padding:10px 0px;border-top:1px solid #e8e8e8;">
                <div class="col-md-12 font-alt post-title">{{ $post->title }}</div>
            </div>
            <div class="row media-photo-detail text-center pb-10" style="padding-top:10px;border-top:1px solid #e8e8e8;">
                <!-- collapse start -->
                <div id="showPhotoDetail" class="font-alt post-title" style="cursor: pointer;">Photo Details</div>
                <div id="exifData" style="display:none;">
                    @if(isset($post->exif))

                        @if(isset($post->exif['camera']))
                            {{ $post->exif['camera'] }} <br>
                        @endif

                        @if(isset($post->exif['lens']))
                           {{ $post->exif['lens'] }} <br>
                        @endif

                        {{ isset($post->exif['focal_length']) ? $post->exif['focal_length'] : '' }}&nbsp;
                        {{ isset($post->exif['shutter_speed']) ? $post->exif['shutter_speed'] : '' }}&nbsp;
                        {{ isset($post->exif['aperture']) ? $post->exif['aperture'] : '' }}&nbsp;

                        @if(isset($post->exif['iso']))
                           {{ $post->exif['iso'] }} <br>
                        @endif

                        @if(isset($post->exif['date_taken']))
                           {{ date('d-m-Y H:i:s', strtotime($post->exif['date_taken'])) }}
                        @endif
                    
                    @else
                    No Photo Detail
                    @endif
                </div>
                <!-- collapse end -->
            </div>
            <div class="row comment-section">
                @if(\Auth::check()) 
                <div class="comments" style="margin:10px 0;">
                    <div class="col-md-2 pp text-center">
                        @if(\App\Models\User::currentPhoto())
                            <img src="{{ url(\App\Models\User::currentPhoto()) }}" />
                        @else
                            <img src="{{ url('') }}/rythm/images/user-avatar.png">
                        @endif
                    </div>
                    <div class="col-md-10 comment-input">
                        <input id="commentPhoto" type="text" class="input-md round form-control" name="comment" placeholder="Add a comment">
                    </div>
                </div>
                @endif
            </div>    
            <div class="row comment-section">
                <div class="dynamicComment">
                    <!-- repeated comments -->
                    @foreach($comments as $comment)
                        @include('partials/single-comment')
                    @endforeach

                    <div id="dynamicComment"></div>
                </div>
            </div>
        </div>
        
    </div>
</div>