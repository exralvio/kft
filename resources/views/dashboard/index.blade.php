@extends('layouts/timeline')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')   
<style type="text/css">
    .timeline-post{
        max-width:650px;
        margin: 0 auto 50px auto;
        background: #ffffff;
        -webkit-box-shadow: 0px 1px 10px 1px rgba(230,230,230,1);
        -moz-box-shadow: 0px 1px 10px 1px rgba(230,230,230,1);
        box-shadow: 0px 1px 10px 1px rgba(230,230,230,1);
    }
    .post-header{
        padding: 10px;
    }
    .post-container{
        display: inline-block;
        vertical-align: top;
        margin-left: 5px;
    }
    .poster{
        text-align: left;
        display: table;
        font-weight: bold;
    }
    .published-text, .post-date{
        text-align: left;
        font-size: 10px;
    }
    .poster-pp{
        width: 40px;
        height: 40px;
        display: inline-block;
    }
    .poster-pp img {
        border-radius: 50px;
    }
    .category-text{
        font-weight: bold;
    }
    .post-footer{
        padding: 10px;
    }
    .ajax-load{
        background: transparent;
        padding: 10px 0px;
        width: 100%;
    }
    a.button-rounded{
        border: 1px solid #ccc;
        margin: 2px;
        border-radius: 15px;
        padding: 5px 15px 5px 17px;
        text-decoration: none;
        cursor: pointer;
    }
    .blue-sky-bg{
        background-color: #0099e5;
        color: #ffffff;
        font-weight: bold;
        border:none!important;
    }
    .blue-sky-bg:hover{
        background-color: #1fb5ff;
        color: #ffffff;
    }
    .team-item-image {
        margin: 0 5px;
    }
    .post-description{
        margin-top:10px;
    }
    .post-title{
        font-weight: bold;
    }
</style>

<section class="page-section pt-100">
    <div class="container relative">
        <div class="col-xs-12 col-lg-10 col-lg-push-1 post-wrapper">

            <div class="row" id="post-data">
                @include('dashboard/single-post')
            </div>

            <!-- Ajax Loader -->
            <div class="text-center ajax-load"  style="display:none">
                <p><img src="{{url('images/ajax-loader.gif')}}">Loading More post</p>
            </div>

        </div>
    </div>
</section>

<style type="text/css">
    .modal-fs{max-width: none!important;}
    .border-right{border-right:1px solid #cccccc;}
    .comment-photo img{padding:5px;max-height: 579px;}
    .comment-block{margin-top:10px;}
    .comment-photo-detail, .comment-block{margin-right: 0;}
    .comment-block .pp{padding: 0px;height: 35px;overflow: hidden;}
    .comment-block .pp img{height:30px;width: auto; border-radius:30px;}
    .comment-user-block{margin: 10px 0 0 0; padding-left: 0;}
    .comment-user-block .pp{height: 50px;width: 50px;overflow: hidden; float: left;}
    .comment-user-block .pp img{border-radius: 25px;}
    .comment-input{padding-left:0px;text-align: left;font-size:12px}
    .profile-name, .following-status{text-align: left;margin-left: 60px;font-weight: bold;}
    .comment-buttons{margin-top: 40px;text-align: left;margin-bottom: 10px;}
    .comments{width: 100%;padding: 2px;float: left;}
    .remodal-close {right: 0;z-index: 9999;left:inherit!important;}
    .dynamicComment{max-height: 400px;overflow-y: scroll;padding:0;}
    .comment-text:hover .del-comment{font-weight: bold; display: block!important;}
    .input-comment-bg{
        background: url('../images/chat-bubble.png');
        background-size: contain;
        background-position: right;
        background-repeat: no-repeat;
    }
</style>
<div class="modal-fs" id="commentPost" data-remodal-id="commentPostModal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div id="comment-content"></div>
</div>

<script type="text/javascript">
    window.onload = function(){

        var postId = null;
        var inst = $('[data-remodal-id=commentPostModal]').remodal();
        $('#post-data').on('click', 'a.comment-button', function(e) {
            $.ajax({
                url: '/loadCommentPage/'+e.currentTarget.id,
                type: "get",
                beforeSend: function()
                {
                    postId = e.currentTarget.id
                    // $('.ajax-load').show();
                    //show loader
                }
            })
            .done(function(data)
            {
                $('#comment-content').empty();
                $('#comment-content').append(data);
                inst.open();
                /* $('#accordion').find('.panel-default:has(".in")').addClass('panel-primary');
                $('#accordion').on('show.bs.collapse', function(e) {
                    $(e.target).closest('.panel-default').addClass(' panel-primary');
                    $('.collapse').collapse('hide');
                }).on('hide.bs.collapse', function(e) {
                    $(e.target).closest('.panel-default').removeClass(' panel-primary');
                }) */
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('failed to connect to server ...');
            });
        });

        $('#comment-content').on('keyup','#commentPhoto', function(e){
            if(e.keyCode == 13){
                $.ajax({
                    url: '/postComment',
                    type: "post",
                    data: { 
                        _token: '{{csrf_token()}}',
                        comment : e.target.value,
                        post_id: postId
                    }
                })
                .done(function(data)
                {
                    e.currentTarget.value = "";
                    $('#dynamicComment').append(data);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('failed to connect to server ...');
                });
            }
        })
        
        $('#comment-content').on('click','.del-comment', function(e){
            var id = e.currentTarget.id.replace('del-','');
            $.ajax({
                url: '/deleteComment',
                type: "post",
                data: { 
                    _token: '{{csrf_token()}}',
                    comment_id: id
                }
            })
            .done(function(data)
            {
                $('#comment-'+id).remove();
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('failed to connect to server ...');
            });
        });

        $('#comment-content').on('click','#showPhotoDetail', function(e){
            $('#exifData').toggle();
            console.log('im clicked');
        })

        var prev_id = null;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                var last_id = $(".timeline-post:last").attr("id");
                if(prev_id != last_id){
                    prev_id = last_id;
                    loadMoreData(last_id);
                }
            }
        });
    
        function loadMoreData(last_id){
            $.ajax({
                url: '/loadMorePost/'+last_id,
                type: "get",
                beforeSend: function()
                {
                    $('.ajax-load').show();
                }
            })
            .done(function(data)
            {
                $('.ajax-load').hide();
                $("#post-data").append(data);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('failed to connect to server ...');
            });
        }
    } 
</script>
@endsection

