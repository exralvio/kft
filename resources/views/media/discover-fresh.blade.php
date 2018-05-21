@foreach($medias as $fresh)
<a href="{{ url('/media/'.$fresh['media']['id']) }}" data-postid="{{ $fresh['media']['id'] }}" class="open-single-post photo-grid-item">
    <img src="{{ url('').'/'.$fresh->images['medium'] }}" class="photo-grid-img" />

    <div class="photo-grid-desc">
        <div class="photo-grid-pp photo-grid-link" data-link="{{ url('user/'.$fresh->user['id']) }}">                                
            <img src="{{ !empty($fresh->user['photo']) ? url($fresh->user['photo']) : url('images/pp-icon.png') }}" class="photo-grid-link-img">
        </div>

        <span class="photo-grid-link" data-link="{{ url('user/'.$fresh->user['id']) }}" >
            {{ $fresh['user']['fullname'] }}
        </span>

        @if($fresh['user']['id'] != $current_user_id)
        <button data-postid="{{ $fresh['media']['id'] }}" class="like-button like-mini-{{ $fresh['media']['id'] }} {{ $fresh->isLiked($current_user_id) ? 'liked' : '' }}"><i class="fa fa-heart-o"></i></button>
        @endif
    </div>
    
</a>
@endforeach