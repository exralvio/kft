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
        alert('failed to connect to server ...');
    });
}

function openSinglePost(e){
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
        alert('failed to connect to server ...');
    });
}

$(function(){
    $('body').on('click', '.open-single-post', openSinglePost);

    $('#post-data, #comment-content').on('click', 'a.like-button', function(e) {
        var postId = $(this).data('postid');
        $.ajax({
            url: '/likePost',
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 
                post_id: postId
            }
        })
        .done(function(data){
            if(data.status == 'liked'){
                $('.like-'+postId).addClass('liked-bg');
                $('.like-'+postId).removeClass('blue-sky-bg');
            }else{
                $('.like-'+postId).addClass('blue-sky-bg');
                $('.like-'+postId).removeClass('liked-bg');
            }
            console.log('#like-count-'+e.currentTarget.id);
            $('#like-count-'+postId).text(data.like_count);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            alert('failed to connect to server ...');
        });
    });

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