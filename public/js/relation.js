$(function(){
	$('.btn-follow.followed', 'body').on('mouseover', function(){
		$(this).text('Unfollow');
	}).on('mouseout', function(){
		$(this).text('Followed');
	});

	$('.btn-follow').on('click', function(e){
		e.preventDefault();

		$(this).prop('disabled', true);

		var userid = $(this).data('userid');
		var action = $(this).hasClass('followed') ? 'unfollow' : 'follow';
		var postUrl = $(this).data('action');
		var postData = {
				"_token": $('meta[name="csrf-token"]').attr('content'),
				"action": action, 
				"user_id": userid
		};

		var that = this;

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
					console.log(response.errors);
				}

				$(that).prop('disabled', false);
			}
		});
	});
});