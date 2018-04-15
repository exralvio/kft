function loadNotification(e){
    e.preventDefault();

    $('.notification-box').toggleClass('open');

    $.ajax({
        url: '/loadNotificationContent',
        type: "get",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .done(function(data)
    {
        $('.notification-list').empty();
        $('.notification-list').append(data);
        $('#activeNotification').empty();
        $('#activeNotification').hide();
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('failed to connect to server ...');
    });
}

function checkUnreadNotification() {
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

function openSetting(e){
    e.preventDefault();

    $('.setting-box').toggleClass('open');
}

$('.nav-notification').on('click', loadNotification);
$('.nav-avatar').on('click', openSetting);

$(function(){
    $(document).mouseup(function(e) 
    {
        var container = $(".notification-box");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$(e.target).hasClass('nav-notification-icon')) 
        {
            if($(".notification-box").hasClass('open')){
                $(".notification-box").removeClass('open');
            }
        }

        if (!container.is(e.target) && container.has(e.target).length === 0 && !$(e.target).hasClass('nav-avatar-image')) 
        {
            if($(".setting-box").hasClass('open')){
                $(".setting-box").removeClass('open');
            }
        }
    });
});

var editProfile = $('[data-remodal-id=editProfile]').remodal({closeOnConfirm: true, hashTracking: false});

$('.btn-open-setting').on('click', function(e){
    e.preventDefault();
    editProfile.open();
});
