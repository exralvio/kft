@foreach($medias as $popular)
<a href="{{ url('/media/'.$popular->media['id']) }}" data-postid="{{ $popular->media['id']}}" class="open-single-post photo-grid-item">
    <img src="{{ url('').'/'.$popular['images']['medium'] }}" class="photo-grid-img" />

    <div class="photo-grid-desc">
        <div class="photo-grid-pp photo-grid-link" data-link="{{ url('user/'.$popular->user['id']) }}">                                
            <img src="{{ !empty($popular->user['photo']) ? url($popular->user['photo']) : url('images/pp-icon.png') }}" class="photo-grid-link-img">
        </div>

        <span class="photo-grid-link" data-link="{{ url('user/'.$popular->user['id']) }}" >
           {{ $popular['user']['fullname'] }}
        </span>

        @if($popular->user['id'] != $current_user_id)
        <button data-postid="{{ $popular->media['id'] }}" class="like-button like-mini-{{ $popular->media['id'] }} {{ $popular->isLiked($current_user_id) ? 'liked' : '' }}"><i class="fa fa-heart-o"></i></button>
        @endif
    </div>
    
</a>
@endforeach