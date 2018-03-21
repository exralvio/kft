@foreach($posts as $post)
<div class="timeline-post mb-xs-30 wow fadeInUp" id="{{ $post->_id }}">
    <div>

        <div class="post-header">
            <div class="poster-pp">
                <img src="{{ isset($post->user_detail['photo']) ? $post->user_detail['photo'] : url('images/pp-icon.png') }}"/>
            </div>
            <div class="post-container font-alt">
                <div class="poster">{{ $post->user_detail['first_name'] }} {{ isset($post->user_detail['last_name']) ? $post->user_detail['last_name'] : '' }}</div>
                <div class="publish-date">{{ $post->created_at->diffForHumans() }}</div>
            </div>
        </div>
            
        <div class="team-item-image">
            <img src="{{ $post->images['medium'] }}" alt="{{ $post->title }}" />
            <!-- <div class="team-item-detail">
                <h4 class="font-alt category-text">{{ isset($post->category_detail['name']) ? $post->category_detail['name'] : '' }}</h4>
                <h4 class="font-alt normal">{{ $post->title }}</h4>
            </div> -->
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
                <a class="button-rounded blue-sky-bg">
                    <i class="fa fa-heart-o"></i> {{ count($post->like_users) }}
                </a>
            </div>
            <div class="col-md-12 post-description">{{ $post->description }}</div>
        </div>
        
    </div>
</div>
@endforeach