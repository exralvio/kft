@foreach($posts as $post)
<div class="timeline-post wow fadeInUp mb-20" id="{{ $post->_id }}">
    <div>

        <div class="post-header">
            <div class="poster-pp">
                <img src="{{ isset($post->user['photo']) ? $post->user['photo'] : url('images/pp-icon.png') }}"/>
            </div>
            <div class="post-container">
                <div class="poster"><a class="profile-link" href="{{ url('profile/'.$post->user['id']) }}">{{ $post->user['fullname'] }}</a></div>
                <div class="publish-date">{{ $post->created_at->diffForHumans() }}</div>
            </div>
        </div>
            
        <div class="team-item-image open-single-post" data-postid="{{ $post->_id }}" >
            <img src="{{ $post->images['medium'] }}" alt="{{ $post->title }}" />
        </div>

        <div class="row post-footer">
            <div class="col-xs-12">
                <div class="col-xs-6 post-title">{{ $post->title }}</div>
                <div class="col-xs-6 text-right post-action" >
                    <div class="row">
                        
                        <a id="{{ $post->_id }}" data-postid="{{ $post->_id }}" class=" comment-button open-single-post" href="#">
                            <i class="fa fa-comment-o"></i>
                        </a>
                        <!-- <a class="button-rounded">
                            <i class="fa fa-plus-square-o"></i> 
                        </a> -->
                        @if($post->liked)
                        <a data-postid="{{ $post->_id }}" class="like-{{ $post->_id }} like-button button-rounded liked">
                            <i class="fa fa-heart"></i> 
                            <span id="like-count-{{ $post->_id }}">{{ count($post->like_users) }}</span>
                        </a>
                        @else
                        <a data-postid="{{ $post->_id }}" class="like-{{ $post->_id }} like-button">
                                <i class="fa fa-heart-o"></i> 
                                <span id="like-count-{{ $post->_id }}">{{ count($post->like_users) }}</span>
                            </a>
                        @endif
                    </div>
                </div>
                @if(!empty($post->description))
                <div class="col-md-12 post-description">{{ $post->description }}</div>
                @endif
            </div>
            
        </div>
        
    </div>
</div>
@endforeach