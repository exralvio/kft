@if(isset($is_popular) and $is_popular == true)
    <div class="timeline-post wow fadeIn mb-20" id="{{ $post['media']['id'] }}">
        <div>

            <div class="post-header">
                <div class="poster-pp">
                    <a href="{{ url('user/'.$post['user']['id']) }}">
                        <img src="{{ !empty($post['user']['photo']) ? url($post['user']['photo']) : url('images/pp-icon.png') }}"/>
                    </a>
                </div>
                <div class="post-container">
                    <div class="poster"><a class="profile-link" href="{{ url('user/'.$post['user']['id']) }}">{{ $post['user']['fullname'] }}</a></div>
                    <div class="publish-date">{{ \Carbon\Carbon::parse($post['media']['created_at'])->diffForHumans() }}</div>
                </div>
                @if(isset($is_popular) and $is_popular == true)
                    <div class="pull-right">                
                        <span class="btn btn-warning btn-xs strong">Popular</span>
                    </div>
                @endif
            </div>
                
            <div class="team-item-image open-single-post" data-postid="{{ $post['media']['id'] }}" >
                <div class="single-post-inner">                
                    <img src="{{ $post->images['medium'] }}" alt="{{ $post->title }}" />
                </div>
            </div>

            <div class="row post-footer">
                <div class="col-xs-12">
                    <div class="col-xs-6 post-title">{{ $post->title }}</div>
                    <div class="col-xs-6 text-right post-action" >
                        <div class="row">
                            
                            <a data-postid="{{ $post['media']['id'] }}" class=" comment-button open-single-post" href="#">
                                <i class="fa fa-comment-o"></i>
                            </a>
                            <!-- <a class="button-rounded">
                                <i class="fa fa-plus-square-o"></i> 
                            </a> -->
                            <a data-postid="{{ $post['media']['id'] }}" class="like-{{ $post['media']['id'] }} like-button {{ $post->isLiked($current_user_id) ? 'liked' : '' }} {{ $post->isSelfBelong($current_user_id) ? 'disabled' : '' }}">
                                <i class="fa {{ $post->isLiked($current_user_id) ? 'fa-heart' : 'fa-heart-o' }}"></i> 
                                <span id="like-count-{{ $post['media']['id'] }}">10</span>
                            </a>
                        </div>
                    </div>
                    @if(!empty($post->description))
                    <div class="col-md-12 post-description">{{ $post->description }}</div>
                    @endif
                </div>
                
            </div>
            
        </div>
    </div>
@else
    <div class="timeline-post wow fadeIn mb-20" id="{{ $post->_id }}">
        <div>

            <div class="post-header">
                <div class="poster-pp">
                    <a href="{{ url('user/'.$post['user']['id']) }}">
                        <img src="{{ !empty($post['user']['photo']) ? url($post['user']['photo']) : url('images/pp-icon.png') }}"/>
                    </a>
                </div>
                <div class="post-container">
                    <div class="poster"><a class="profile-link" href="{{ url('user/'.$post['user']['id']) }}">{{ $post['user']['fullname'] }}</a></div>
                    <div class="publish-date">{{ $post['created_at']->diffForHumans() }}</div>
                </div>
            </div>
                
            <div class="team-item-image open-single-post" data-postid="{{ $post->_id }}" >
                <div class="single-post-inner">
                    <img src="{{ $post->images['medium'] }}" alt="{{ $post->title }}" />
                </div>
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

                            <a data-postid="{{ $post->_id }}" class="like-{{ $post->_id }} like-button {{ $post->isLiked($current_user_id) ? 'liked' : '' }} {{ $post->isSelfBelong($current_user_id) ? 'disabled' : '' }}">
                                <i class="fa {{ $post->isLiked($current_user_id) ? 'fa-heart' : 'fa-heart-o' }}"></i> 
                                <span id="like-count-{{ $post->_id }}">{{ $post->like_count }}</span>
                            </a>

                            <a id="fb_link" title="share on facebook" class="btn btn-social-icon btn-facebook share-button-round" share-url="{{ url('media').'/'.$post->_id }}" share-title="{{ $post->description }}" onclick="fbs_click(this);">
                                <span class="fa fa-facebook"></span>
                            </a>

                            <a id="twt_link_popup" title="share on twitter" class="btn btn-social-icon btn-twitter share-button-round" share-url="{{ url('media').'/'.$post->_id }}" share-title="{{ $post->description }}" onclick="twt_click(this);">
                                <span class="fa fa-twitter"></span>
                            </a>

                        </div>
                    </div>
                    @if(!empty($post->description))
                    <div class="col-md-12 post-description">{{ $post->description }}</div>
                    @endif
                </div>
                
            </div>
            
        </div>
    </div>
@endif