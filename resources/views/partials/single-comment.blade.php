<div class="comment-each comment-{{ $comment->_id }} col-xs-12 mb-10">
    <div class="row">
        <div class="col-xs-2 pp text-center">
            <img src="{{ url($comment->user['photo']) }}"/>
        </div>
        <div class="col-xs-10 comment-content align-left">
            <div class="comment-name"><a href="{{ url('profile/'.$comment->user['id']) }}">{{ $comment->user['fullname'] }}</a></div>
            <p class="mb-0">{{ $comment->comment }}</p>
            <div class="comment-action">
                <a href="#" class="comment-reply">Reply</a> <span>- {{ $comment->created_at->format('M d') }}</span>
                
                @if(\Auth::check()) 
                    @if($current_user_id == $comment->user['id'])
                    <a href="#" class=" del-comment pull-right" data-mediaid="{{ $comment->_id }}"><i class="fa fa-times"></i></a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>