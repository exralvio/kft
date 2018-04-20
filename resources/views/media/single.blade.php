<div class="row">
    <input id="postId" type="hidden" value="{{ $post->_id }}">
    <div class="col-xs-12 col-md-9">
        <div class="media-photo text-center">
            <img src="{{ url($post['images']['large']) }}">
        </div>
    </div>
    <div class="col-xs-12 col-md-3 media-detail-right">
        <div class="post-details">
            <div class="comment-user-block">
                <div class="mt-20 mb-10">
                    <div class="pp">
                        <a href="{{ url('user/'.$post['user']['id']) }}">
                            <img src="{{ !empty($post->user['photo']) ? url($post->user['photo']) : url('images/pp-icon.png') }}"/>
                        </a>
                    </div>
                    <div class="comment-profile-name">
                        <a class="profile-link" href="{{ url('user/'.$post->user['id']) }}">{{ $post->user['fullname'] }}</a>
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
            <div class="media-photo-title align-left">
                <h5>
                    {{ $post->title }}
                </h5>
                @if(!empty($post->description))
                    <p>
                        {{ $post->description }}
                    </p>
                @endif
            </div>
            <div class="media-photo-detail text-center pb-10">
                <a class="open-post-detail open">
                  Details
                </a>
                <div class="post-info pb-10 pt-10">
                    @if(isset($post->exif))

                        @if(isset($post->exif['camera']))
                        <div class="post-info-camera">
                           {{ $post->exif['camera'] }}
                        </div>
                        @endif

                        @if(isset($post->exif['lens']))
                        <div class="post-info-lens">
                            {{ $post->exif['lens'] }}
                        </div>
                        @endif

                        @if(isset($post->exif['focal_length']) || isset($post->exif['shutter_speed']) || isset($post->exif['aperture']) || isset($post->exif['iso']))
                        <div class="post-info-meta mb-20">
                            @if(isset($post->exif['focal_length']))
                                <span>{{ $post->exif['focal_length'] }}</span>
                            @endif
                            @if(isset($post->exif['shutter_speed']))
                                <span>{{ $post->exif['shutter_speed'] }}</span>
                            @endif
                            @if(isset($post->exif['aperture']))
                                <span>{{ $post->exif['aperture'] }}</span>
                            @endif
                            @if(isset($post->exif['iso']))
                               <span>ISO {{ $post->exif['iso'] }}</span>
                            @endif
                        </div>
                        @endif
                    
                    @endif
                    <div class="post-info-detail">
                        <label>Category</label>
                        <span>{{ $post->category['name'] }}</span>
                        <div class="clearfix"></div>
                    </div>
                    @if(isset($post->exif['date_taken']) || !empty($post->exif['date_taken']))
                    <div class="post-info-detail">
                        <label>Taken</label>
                        <span>{{ $post->exif['date_taken'] }}</span>
                        <div class="clearfix"></div>
                    </div>
                    @endif
                    <div class="post-info-detail">
                        <label>Uploaded</label>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                        <div class="clearfix"></div>
                    </div>
                </div>
                    
                </div>
                <!-- collapse end -->
            </div>
            <div class="row comment-section">
                @if(\Auth::check()) 
                <div class="comments" style="margin:10px 0;">
                    <div class="col-md-2 col-xs-2 pp text-center">
                        <a href="{{ url('user/'.$post['user']['id']) }}">
                        @if(\App\Models\User::currentPhoto())
                            <img src="{{ url(\App\Models\User::currentPhoto()) }}" />
                        @else
                            <img src="{{ url('') }}/rythm/images/user-avatar.png">
                        @endif
                        </a>
                    </div>
                    <div class="col-md-10 col-xs-10 comment-input">
                        <input id="commentPhoto" type="text" class="input-md round form-control" name="comment" placeholder="Add a comment">
                        <a class="add-new-comment"><i class="fa fa-send"></i></a>
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