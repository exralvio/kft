<div class="row">
    <input id="postId" type="hidden" value="{{ $post->_id }}">
    <div class="col-md-9 comment-photo border-right">
        <img src="{{url('').'/'.$post->images['original'] }}">
    </div>
    <div class="col-md-3">
        <div class="row comment-user-block">
            <div class="pp">
                <img src="{{ url($post->user['photo']) }}">
            </div>
            <div class="comment-profile-name">
                {{ $post->user['firstname'] }} {{ $post->user['lastname'] }}
            </div>
            @if(\Auth::check() and $post->user['id'] != \App\Models\User::current()['_id'])
            <div class="comment-profile-follow">
                @if(\App\Models\User::isFollower($post->user['id']))
                <a class="btn btn-sm btn-follow followed follow-{{ $post->user['id'] }}" data-userid="{{ $post->user['id'] }}" data-action="{{ url('user/relation') }}">Followed</a>
                @else
                <a class="btn btn-sm btn-follow follow-{{ $post->user['id'] }}" data-userid="{{ $post->user['id'] }}" data-action="{{ url('user/relation') }}">Follow</a>
                @endif
            </div>
            @endif
            <!-- <div class="following-status">
                following
            </div> -->
            <div class="comment-buttons">
                @if($post->liked)
                <a id="like-{{ $post->_id }}" data-postid="{{ $post->_id }}" class="like-{{ $post->_id }} like-button button-rounded liked-bg">
                    <i class="fa fa-heart-o"></i> 
                    <span id="like-count-{{ $post->_id }}">{{ count($post->like_users) }}</span>
                </a>
                @else
                <a id="like-{{ $post->_id }}" data-postid="{{ $post->_id }}" class="like-{{ $post->_id }} like-button button-rounded blue-sky-bg">
                        <i class="fa fa-heart-o"></i> 
                        <span id="like-count-{{ $post->_id }}">{{ count($post->like_users) }}</span>
                    </a>
                @endif
            </div>
        </div>
        <div class="row comment-photo-detail" style="padding:10px 0px;border-top:1px solid #e8e8e8;">
            <div class="col-md-12 font-alt post-title">{{ $post->title }}</div>
        </div>
        <div class="row comment-photo-detail" style="padding-top:10px;border-top:1px solid #e8e8e8;">
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
        <div class="row comment-block" style="border-top:1px solid #e8e8e8;">
            @if(\Auth::check()) 
            <div class="comments" style="margin:10px 0;">
                <div class="col-md-2 pp">
                    @if(Session::has('user')) 
                    <img src="{{ url(\App\Models\User::currentPhoto()) }}" />
                    @else
                    <img src="{{ url('') }}/rythm/images/user-avatar.png">
                    @endif
                </div>
                <div class="col-md-10 comment-input">
                    <input id="commentPhoto" type="text" class="input-md round form-control input-comment-bg" name="comment" placeholder="Add a comment">
                </div>
            </div>
            @endif

            <div class="col-md-12 dynamicComment">
                <!-- repeated comments -->
                @foreach($comments as $comment)
                <div id="comment-{{ $comment->_id }}" class="comments">
                    <div class="col-md-2 pp">
                        <img src="{{ url($comment->user['photo']) }}"/>
                    </div>
                    <div class="col-md-10 comment-input comment-text">
                        <div style="font-weight: bold;">{{ $comment->user_detail['first_name'] }} {{ $comment->user_detail['last_name'] }}</div>
                        {{ $comment->comment }}
                        @if(\Auth::check()) 
                            @if(Session::get('user')->_id == $comment->user_id)
                            <div id="del-{{ $comment->_id }}" class="del-comment" style="width: 1px;height: 1px;float: right;cursor: pointer;display:none">x</div>
                            @endif
                        @endif
                    </div>
                </div>
                @endforeach

                <div id="dynamicComment"></div>
            </div>
        </div>
    </div>
</div>