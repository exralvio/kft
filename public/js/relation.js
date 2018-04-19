$(function(){
	$('body').on('mouseover', '.btn-follow.followed', function(e){
		$(this).text('Unfollow');
	}).on('mouseout', '.btn-follow.followed',function(e){
		$(this).text('Followed');
	});

	$('body').on('click', '.btn-follow', function(e){
		e.preventDefault();

		$(e.target).prop('disabled', true);

		var userid = $(e.target).data('userid');
		var action = $(e.target).hasClass('followed') ? 'unfollow' : 'follow';
		var postUrl = $(e.target).data('action');
		var postData = {
				"_token": $('meta[name="csrf-token"]').attr('content'),
				"action": action, 
				"user_id": userid
		};

		var that = e.target;

		$.ajax({
			url: postUrl,
			data: postData,
			type: 'post',
			dataType: 'json',
			success: function(response){
				if(response.status == 'success'){
					if(action == 'follow'){
						$('.follow-'+userid).addClass('followed');
						$('.follow-'+userid).text('Followed');
					} else if(action == 'unfollow'){
						$('.follow-'+userid).removeClass('followed');
						$('.follow-'+userid).text('Follow');
					}
				} else if(response.status == 'error'){
					alert(response.errors);
				}

				$(that).prop('disabled', false);
			}
		}).fail(function(jqXHR, ajaxOptions, thrownError)
	    {
	        if(thrownError == 'Unauthorized'){
	            window.location = '/login';
	            return;
	        }

	        alert('failed to connect to server ...');
	    });;
	});
});