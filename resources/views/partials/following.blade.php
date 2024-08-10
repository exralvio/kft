<div class="col-md-12">
    <div class="follow-name"><b>Followings</b></div>
    <ul id="follow-list">
        @foreach($followings as $f)
        <li>
            <div class="col-md-2 follow-pict">
                @if(strpos($f['photo'], 'http') === 0)
                <img src="{{ $f['photo'] }}"/>
                @else
                <img src="{{ url('').'/'.$f['photo'] }}"/>
                @endif
            </div>
            <div class="col-md-6 follow-name">{{ $f['fullname'] }}</div>
        </li>
        @endforeach
    </ul>
</div>