<div class="comment-each comment-{{ $comment->_id }} col-xs-12 mb-10">
    <div class="reply-line"></div>
    <div class="row">
        <div class="col-xs-2 pp text-center">
            <a href="{{ url('user/'.$comment->user['id']) }}">
                <img src="{{ !empty($comment->user['photo']) ? url($comment->user['photo']) : url('images/pp-icon.png') }}"/>
            </a>
        </div>
        <div class="col-xs-10 comment-content align-left">
            <div class="comment-name"><a href="{{ url('user/'.$comment->user['id']) }}">{{ $comment->user['fullname'] }}</a></div>
            <p>{{ $comment->comment }}</p>
            <div class="comment-action">
                <!-- <span>- {{ $comment->created_at->format('M d') }}</span> -->
                
                <a href="#" commentId="{{ $comment->_id }}" class="comment-reply">Reply</a> &nbsp;
                <span>{{ $comment->created_at->format('M d') }}</span>
                
                @if(\Auth::check()) 
                    @if($current_user_id == $comment->user['id'])
                    <a href="#" class=" del-comment pull-right" data-mediaid="{{ $comment->_id }}"><i class="fa fa-times"></i></a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>