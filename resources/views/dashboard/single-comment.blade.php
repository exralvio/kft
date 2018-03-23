<div id="comment-{{ $comment->_id }}" class="comments">
    <div class="col-md-2 pp">
        <img src="{{ $comment->user_detail['photo'] }}"/>
    </div>
    <div id="del-{{ $comment->_id }}" class="col-md-10 comment-input comment-text">
        <div style="font-weight: bold;">{{ $comment->user_detail['first_name'] }} {{ $comment->user_detail['last_name'] }}</div>
        {{ $comment->comment }}
    </div>
</div>