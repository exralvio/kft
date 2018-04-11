@foreach($medias as $popular)
<li class="work-item mix photography" >
    <div data-postid="{{ $popular['media']['id'] }}" class="work-item-inner open-single-post">
        <div class="work-img">
            <img src="{{ url($popular['images']['medium']) }}" alt="Work">
        </div>
        <div class="work-intro align-left">
            <div class="work-pp">
                <img src="{{ url($popular->user['photo']) }}">
            </div>
            <h3 class="work-title">{{ $popular['user']['fullname'] }}</h3>
            <a data-postid="{{ $popular->media['id'] }}" class="like-button like-mini-{{ $popular->media['id'] }} {{ $popular->isLiked($current_user_id) ? 'liked' : '' }}"><i class="fa fa-heart-o"></i></a>
        </div>
    </div>
</li>
@endforeach