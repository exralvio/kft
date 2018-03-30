@foreach($posts as $post)
<div class="timeline-post mb-xs-30 wow fadeInUp" id="{{ $post->_id }}">
    <div>

        <div class="post-header">
            <div class="poster-pp">
                <img src="{{ isset($post->user['photo']) ? $post->user['photo'] : url('images/pp-icon.png') }}"/>
            </div>
            <div class="post-container font-alt">
                <div class="poster"><a class="profile-link" href="{{ url('profile/'.$post->user['id']) }}">{{ $post->user['fullname'] }}</a></div>
                <div class="publish-date">{{ $post->created_at->diffForHumans() }}</div>
            </div>
        </div>
            
        <div class="team-item-image open-single-post" data-postid="{{ $post->_id }}" >
            <img src="{{ $post->images['medium'] }}" alt="{{ $post->title }}" />
        </div>

        <div class="row post-footer">
            <div class="col-md-6 font-alt post-title">{{ $post->title }}</div>
            <div class="col-md-6 text-right" style="margin-top: 5px;">
                <a id="{{ $post->_id }}" data-postid="{{ $post->_id }}" class="button-rounded comment-button open-single-post" href="#">
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