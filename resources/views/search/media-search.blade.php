@foreach($datas as $media)
<li class="work-item" >
    <div data-postid="{{ $media->_id }}" class="work-item-inner open-single-post">
        <div class="work-img">
            <img src="{{ url($media['images']['medium']) }}" alt="Work">
        </div>
        <div class="work-intro">
            <div class="work-pp">
                <img src="{{ !empty($media->user['photo']) ? url($media->user['photo']) : url('images/pp-icon.png') }}"/>
            </div>
            <h3 class="work-title">{{ $media['user']['fullname'] }}</h3>
            <a data-postid="{{ $media->_id }}" class="like-button like-mini-{{ $media->_id }} {{ $media->isLiked($current_user_id) ? 'liked' : '' }}"><i class="fa fa-heart-o"></i></a>
        </div>
    </a>
</li>
@endforeach