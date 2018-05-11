@foreach($medias as $media)
<a href="{{ url('/media/'.$media['_id']) }}" data-postid="{{ $media->_id }}" class="open-single-post photo-grid-item">
    <img src="{{ url('').'/'.$media->images['medium'] }}" class="photo-grid-img" />

    <div class="photo-grid-desc">
        <div class="photo-grid-pp photo-grid-link" data-link="{{ url('user/'.$media->user['id']) }}">                                
            <img src="{{ !empty($media->user['photo']) ? url($media->user['photo']) : url('images/pp-icon.png') }}" class="photo-grid-link-img">
        </div>

        <span class="photo-grid-link" data-link="{{ url('user/'.$media->user['id']) }}" >
            {{ $media['user']['fullname'] }}
        </span>

        @if(!$media->isSelfBelong($current_user_id))
        <button data-postid="{{ $media->_id }}" class="like-button like-mini-{{ $media->_id }} {{ $media->isLiked($current_user_id) ? 'liked' : '' }}"><i class="fa fa-heart-o"></i></button>
        @endif
    </div>
    
</a>
@endforeach