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
        $('#activeNotification').empty();
        $('#activeNotification').hide();
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('failed to connect to server ...');
    });
});

$('body').on('click',function(){
    $('#notification-content').hide();
})

var editProfile = $('[data-remodal-id=editProfile]').remodal({closeOnConfirm: true, hashTracking: false});

$('.btn-open-setting').on('click', function(e){
    e.preventDefault();
    editProfile.open();
});

function loadNotification() {
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
}
