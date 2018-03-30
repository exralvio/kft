$('.nav-notification').on('click', function(){
    $.ajax({
        url: '/loadNotificationContent',
        type: "get",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .done(function(data)
    {
        $('#notification-content').empty();
        $('#notification-content').append(data);
        $('#notification-content').toggle();
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('failed to connect to server ...');
    });
});

$('body').on('click',function(){
    $('#notification-content').hide();
})

$(document).ready(function(){
    $.ajax({
        url: '/loadUnreadNotification',
        type: "get",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .done(function(data)
    {
        if(data.unread_notification){
            $('#activeNotification').empty();
            $('#activeNotification').append(data.unread_notification);
            $('#activeNotification').show();
        }
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('failed to connect to server ...');
    });
})