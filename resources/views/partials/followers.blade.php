<div class="col-md-12">
    <div class="follow-name"><b>Followers</b></div>
    <ul id="follow-list">
        @foreach($followers as $f)
        <li>
            <div class="col-md-2 follow-pict">
                @if(strpos($f['photo'], 'http') === 0)
                <img src="{{ $f['photo'] }}"/>
                @else
                <img src="{{ url('').'/'.$f['photo'] }}"/>
                @endif
            </div>
            <div class="col-md-6 follow-name">{{ $f['fullname'] }}</div>
            @if(\App\Models\User::isFollower($f['id']))
            <div class="col-md-4 follow-button-cont"><button class="btn small-btn">Following</button></div>
            @else
            <div class="col-md-4 follow-button-cont"><button class="btn small-btn btn-info">Follow</button></div>
            @endif
        </li>
        @endforeach
    </ul>
</div>