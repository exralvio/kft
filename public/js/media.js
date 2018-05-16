var postId = $('#postId').val();
var inst = $('[data-remodal-id=commentPostModal]').remodal({hashTracking: false});

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
        if(thrownError == 'Unauthorized'){
            window.location = '/login';
            return;
        }

        alert('failed to connect to server ...');
    });
}

function openSinglePost(e){
    if($(e.target).hasClass('like-button') || $(e.target).hasClass('photo-grid-link') || $(e.target).hasClass('photo-grid-link-img')){
        e.preventDefault();
        return;
    }

    e.preventDefault();

    var post_id = $(this).data('postid');

    $.ajax({
        url: '/loadMedia/'+post_id,
        type: "get",
        beforeSend: function()
        {
            postId = post_id
        }
    })
    .done(function(data)
    {
        $('#comment-content').empty();
        $('#comment-content').append(data);
        inst.open();
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        if(thrownError == 'Unauthorized'){
            window.location = '/login';
            return;
        }

        alert('failed to connect to server ...');
    });
}

function openPhotogridLink(e){
    var link = $(this).data('link');

    if(!link){
        return;
    }

    window.location = link;
}

function addPostLike(e) {
    e.preventDefault();
    var postId = $(this).data('postid');
    var postAction = !$(this).hasClass('liked') ? 'like' : 'unlike';

    $.ajax({
        url: '/likePost',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { 
            post_id: postId,
            action: postAction
        }
    })
    .done(function(data){
        if(data.status == 'error'){
            alert(data.message);
        } else {
            if(data.status == 'liked'){
                $('.like-'+postId).addClass('liked');
                $('.like-'+postId+' .fa').addClass('fa-heart');
                $('.like-'+postId+' .fa').removeClass('fa-heart-o');
                $('.like-mini-'+postId).addClass('liked');
            } else {
                $('.like-'+postId).removeClass('liked');
                $('.like-'+postId+' .fa').addClass('fa-heart-o');
                $('.like-'+postId+' .fa').removeClass('fa-heart');
                $('.like-mini-'+postId).removeClass('liked');
            }

            $('span','.like-'+postId).text(data.like_count);
        }
    })
    .fail(function(jqXHR, ajaxOptions, thrownError){
        if(thrownError == 'Unauthorized'){
            window.location = '/login';
            return;
        }

        alert('failed to connect to server ...');
    });
}

function addNewComment(e, bypass = false){
    if(e.keyCode != 13 && bypass == false){
        return;
    }

    var message = $('#commentPhoto').val();

    if(message.trim() == ""){
        return;
    }

    $.ajax({
        url: '/postComment',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { 
            // _token: '{{csrf_token()}}',
            comment : message,
            post_id: postId
        }
    })
    .done(function(data)
    {
        $('#commentPhoto').val('');
        $('#dynamicComment').append(data);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        if(thrownError == 'Unauthorized'){
            window.location = '/login';
            return;
        }

        alert('failed to connect to server ...');
    });
}

$(function(){
    $('body').on('click', '.open-single-post', openSinglePost);

    $('body').on('click', 'body', function(){
        $('#replyComment').hide();
    })

    $('body').on('click', '.like-button', addPostLike);

    $('body').on('click', '.photo-grid-link', openPhotogridLink);

    $('body').on('keyup','#commentPhoto', addNewComment);
    $('body').on('click','.add-new-comment', function(e){
        addNewComment(e, true);
    });
    
    $('body').on('click','.add-new-reply', function(e){
        // addNewComment(e, true, $());
    });
    
    $('body').on('click','.del-comment', function(e){
        e.preventDefault();

        if(!confirm("Are you sure want to delete comment?")){
            return;
        }
        
        var media_id = $(this).data('mediaid');
        $.ajax({
            url: '/deleteComment',
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 
                // _token: '{{csrf_token()}}',
                comment_id: media_id
            }
        })
        .done(function(data)
        {
            $('.comment-'+media_id).remove();
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            if(thrownError == 'Unauthorized'){
                window.location = '/login';
                return;
            }
            
            alert('failed to connect to server ...');
        });
    });

    $('body').on('click','#showPhotoDetail', function(e){
        $('#exifData').toggle();
    });
    
    $('body').on('click','.comment-reply', function(e){
        $('#commentReply').attr('parentcomment', $(this).attr('commentId'));
        $('#replyComment').toggle();
    });

    /* $('body').on('click', '.comment-reply', function(e){
        e.preventDefault();
        $('#commentPhoto').focus();
    }); */

    $('body').on('click', '.open-post-detail', function(e){
        e.preventDefault();
        $(this).toggleClass('open');
        $('.post-info').toggleClass('closed');

        $('.post-info:after').css('content',"\f03a");
    });

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
});