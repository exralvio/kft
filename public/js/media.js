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
    e.preventDefault();

    if($(e.target).hasClass('like-button')){
        return;
    }

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

$(function(){
    $('body').on('click', '.open-single-post', openSinglePost);

    $('body').on('click', 'a.like-button', addPostLike);

    $('#comment-content').on('keyup','#commentPhoto', function(e){
        if(e.keyCode == 13){
            $.ajax({
                url: '/postComment',
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { 
                    // _token: '{{csrf_token()}}',
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
                if(thrownError == 'Unauthorized'){
                    window.location = '/login';
                    return;
                }

                alert('failed to connect to server ...');
            });
        }
    })
    
    $('#comment-content').on('click','.del-comment', function(e){
        var id = e.currentTarget.id.replace('del-','');
        $.ajax({
            url: '/deleteComment',
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 
                // _token: '{{csrf_token()}}',
                comment_id: id
            }
        })
        .done(function(data)
        {
            $('#comment-'+id).remove();
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

    $('#comment-content').on('click','#showPhotoDetail', function(e){
        $('#exifData').toggle();
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
});