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