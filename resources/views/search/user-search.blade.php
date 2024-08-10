@foreach($datas as $user)

<div class="col-md-3 grid-user-item pb-20">
    <div class="background-container">
        <a href="{{ url('user/'.$user['_id']) }}" class="grid-user-link" target="_blank"></a>
        <div class="grid-user-img">
            @if(!empty($user['photo']))
                <img src="{{ url($user['photo']) }}">
            @else
                <img src="{{ url('') }}/images/pp-icon.png">
            @endif   
        </div>
        <h6 class="grid-user-name align-center">
            {{ $user['fullname'] }}
        </h6>    
        <div class="grid-user-followers text-center mb-10">
            {{ $user->getFollowerCount() }} Follower{{ $user->getFollowerCount() > 1 ? 's' : ''}}
        </div>
        <div class="grid-user-follow text-center">
            @if(\App\Models\User::isFollower($user['id']))
                <a class="btn btn-sm btn-follow followed follow-{{ $user['id'] }}" data-userid="{{ $user['id'] }}" data-action="{{ url('user/relation') }}">Followed</a>
            @else
                <a class="btn btn-sm btn-follow follow-{{ $user['id'] }}" data-userid="{{ $user['id'] }}" data-action="{{ url('user/relation') }}">Follow</a>
            @endif
        </div>
    </div>
</div>

@endforeach