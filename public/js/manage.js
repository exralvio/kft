function updateEditForm(e){
	$('.manage-item-inner').removeClass('active');
	$(this).addClass('active');

	$('.form-editor')[0].reset();
	$('.edit-keywords').tagsinput('removeAll');
	$('.form-blocker').hide();
	$('.btn-editor-save').text('Save');
	$('.btn-editor-save').prop('disabled', true);

	var media_id = $(this).data('media-id');
	var media = medias[media_id];

	$('.btn-remove-media').data('mediaid', media_id);

	if(typeof media.category.id !== 'undefined')
		$('.edit-category').val(media.category.id);

	if(typeof media.title !== 'undefined')
		$('.edit-title').val(media.title);

	if(typeof media.description !== 'undefined')
		$('.edit-description').val(media.description);

	if(typeof media.keywords !== 'undefined'){
		$.each(media.keywords, function(index, value) {
		    $('.edit-keywords').tagsinput('add', value);
		});

		$('.edit-keywords').val();
	}

	if(typeof media.exif.camera !== 'undefined')
		$('.edit-camera').val(media.exif.camera);

	if(typeof media.exif.lens !== 'undefined')
		$('.edit-lens').val(media.exif.lens);

	if(typeof media.exif.focal_length !== 'undefined')
		$('.edit-fl').val(media.exif.focal_length);

	if(typeof media.exif.date_taken !== 'undefined')
		$('.edit-dt').val(media.exif.date_taken);

	if(typeof media.exif.iso !== 'undefined')
		$('.edit-iso').val(media.exif.iso);

	if(typeof media.exif.shutter_speed !== 'undefined')
		$('.edit-ss').val(media.exif.shutter_speed);

	if(typeof media.exif.aperture !== 'undefined')
		$('.edit-aperture').val(media.exif.aperture);
	
	$('.edit-mediaid').val(media._id);
}

function saveEditForm(e){
	e.preventDefault();

	var formData = $('.form-editor').serializeArray();
	var	postUrl = $('.form-editor').attr('action');

	$('.btn-editor-save').prop('disabled', true);
	$('.btn-editor-save').text('Saving..');

	$.ajax({
		url: postUrl,
		data: formData,
		dataType: 'json',
		type: 'post',
		success: function(response){
			$('.btn-editor-save').text('Saved');
			
			if(typeof response.data !== 'undefined'){
				medias[response.data._id] = response.data;
			}
		}
	});
}

function removeMedia(e){
	e.preventDefault();

	if(!confirm('Are you sure you want to delete this photo?')){
		return false;
	}

	var media_id = $(this).data('mediaid');
	var postUrl = $(this).data('action');
	var postData = {
		"_token": $('meta[name="csrf-token"]').attr('content'),
		"media_id": media_id
	};

	$('.btn-editor-save').prop('disabled', true);
	$('.btn-editor-save').text('Deleting..');

	$.ajax({
		url: postUrl,
		data: postData,
		dataType: 'json',
		type: 'post',
		success: function(response){
			alert("Delete photo success!");
			location.reload();
		}
	});
}

function updateEditorHeight(){
	var managemedia_height = $(window).height() - 75 - 58;
	$('.manage-media').css('height', managemedia_height+'px');

	var formeditor_height = $(window).height() - 75 - 105;
	$('.form-editor').css('height', formeditor_height+'px');
}

$(function(){
	updateEditorHeight();

	$(window).on('resize', updateEditorHeight);

	$('.manage-item-inner').on('click', updateEditForm);

	$('.btn-editor-save').on('click', saveEditForm);

	$('.form-editor').on('change keyup',':input', function(){
		$('.btn-editor-save').prop('disabled', false);
	});

	$('.btn-remove-media').on('click', removeMedia);
});