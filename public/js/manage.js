function updateEditForm(e){
	e.preventDefault();

	$('.form-editor')[0].reset();

	var media_id = $(this).data('media-id');
	var media = medias[media_id];

	if(typeof media.category.id !== 'undefined')
		$('.edit-category').val(media.category.id);

	if(typeof media.title !== 'undefined')
		$('.edit-title').val(media.title);

	if(typeof media.description !== 'undefined')
		$('.edit-description').val(media.description);

	if(typeof media.exif.camera !== 'undefined')
		$('.edit-camera').val(media.exif.camera.value);

	if(typeof media.exif.lens !== 'undefined')
		$('.edit-lens').val(media.exif.lens.value);

	if(typeof media.exif.focal_length !== 'undefined')
		$('.edit-fl').val(media.exif.focal_length.value);

	if(typeof media.exif.date_taken !== 'undefined')
		$('.edit-dt').val(media.exif.date_taken.value);

	if(typeof media.exif.iso !== 'undefined')
		$('.edit-iso').val(media.exif.iso.value);

	if(typeof media.exif.shutter_speed !== 'undefined')
		$('.edit-ss').val(media.exif.shutter_speed.value);

	if(typeof media.exif.aperture !== 'undefined')
		$('.edit-aperture').val(media.exif.aperture.value);
	
	$('.edit-mediaid').val(media._id);
}

$(function(){
	$('.manage-item-inner').on('click', updateEditForm);
});