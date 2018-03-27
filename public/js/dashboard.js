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