<div class="row">
    <div class="col-md-9 comment-photo border-right">
        <img src="{{url('').'/'.$post->images['medium'] }}">
    </div>
    <div class="col-md-3">
        <div class="row comment-user-block">
            <div class="pp">
                <img src="{{ url('').'/'.$post->user_detail['photo'] }}">
            </div>
            <div class="profile-name">
                {{ $post->user_detail['first_name'] }} {{ $post->user_detail['last_name'] }}
            </div>
            <!-- <div class="following-status">
                following
            </div> -->
            <div class="comment-buttons">
                <a class="button-rounded blue-sky-bg">
                    <i class="fa fa-heart-o"></i> {{ count($post->like_users) }}
                </a>
            </div>
        </div>
        <!-- <div class="row comment-photo-detail" style="padding-top:10px;border-top:1px solid #e8e8e8;">
            <b>View</b><br>{{ $post->view_count }}
        </div> -->
        <div class="row comment-block" style="border-top:1px solid #e8e8e8;">
            <div class="comments" style="margin:10px 0;">
                <div class="col-md-2 pp">
                    <img src="{{ url('uploads/shocked_cat.jpeg') }}"/>
                </div>
                <div class="col-md-10 comment-input">
                    <input id="commentPhoto" type="text" class="input-md round form-control" name="comment" placeholder="Add a comment">
                </div>
            </div>

            <div class="row dynamicComment">
                <!-- repeated comments -->
                @foreach($comments as $comment)
                <div id="comment-{{ $comment->_id }}" class="comments">
                    <div class="col-md-2 pp">
                        <img src="{{ $comment->user_detail['photo'] }}"/>
                    </div>
                    <div class="col-md-10 comment-input comment-text">
                        <div style="font-weight: bold;">{{ $comment->user_detail['first_name'] }} {{ $comment->user_detail['last_name'] }}</div>
                        {{ $comment->comment }}
                        @if(Session::get('user')->_id == $comment->user_id)
                        <div id="del-{{ $comment->_id }}" class="del-comment" style="width: 1px;height: 1px;float: right;cursor: pointer;display:none">x</div>
                        @endif
                    </div>
                </div>
                @endforeach

                <div id="dynamicComment"></div>
            </div>
        </div>
    </div>
</div>