<div id="comment-{{ $comment->_id }}" class="comments">
    <div class="col-md-2 pp">
        <img src="{{ url('').'/'.$comment->user_detail['photo'] }}"/>
    </div>
    <div id="del-{{ $comment->_id }}" class="col-md-10 comment-input comment-text">
        <div style="font-weight: bold;">{{ $comment->user_detail['first_name'] }} {{ $comment->user_detail['last_name'] }}</div>
        {{ $comment->comment }}
        @if(Session::get('user')->_id == $comment->user_id)
        <div id="del-{{ $comment->_id }}" class="del-comment" style="width: 1px;height: 1px;float: right;cursor: pointer;display:none">x</div>
        @endif
    </div>
</div>