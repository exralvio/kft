
var upload_images = [];
function resetUploadForm(){
	$('.form-uploader')[0].reset();
	$('.form-blocker').show();
}

function editUploadForm(e){
	var upload_index = $(this).data('upload-index');
	var data = upload_images[upload_index];

	$('.dz-preview').removeClass('dz-active');
	$(this).addClass('dz-active');

	$('.form-blocker').hide();
	$('.upload-title').val(data.title);
	$('.upload-description').val(data.description);
	$('.upload-index').val(upload_index);

	$('.upload-title').on('change keyup paste', function(e){
		var new_val = $(this).val();
		var current_index = $('.upload-index').val();
		upload_images[current_index].title = new_val;
	});

	$('.upload-description').on('change keyup paste', function(e){
		var new_val = $(this).val();
		var current_index = $('.upload-index').val();
		upload_images[current_index].description = new_val;
	});

	$('.upload-keywords').on('itemAdded itemRemoved', function(event) {
		var new_val = $('.upload-keywords').tagsinput('items');
		var current_index = $('.upload-index').val();
		upload_images[current_index].keywords = new_val;
	});
}

$(function(){
	var image_counter = 0;

	Dropzone.autoDiscover = false;

	var dropzoneOptions = {
		dictDefaultMessage: false,
		addRemoveLinks: true,
		clickable: ".dz-addfile",
		thumbnailWidth: 170,
		thumbnailHeight: 110
	};
	
	var mydropzone = new Dropzone('#uploadzone', dropzoneOptions);

	mydropzone.on('addedfile', function(file){

		$(file.previewElement).data('upload-index', image_counter);
		image_counter++;

		$('.dz-message').hide();
		$('.dz-addmore').show();
		$('#uploadzone').removeClass('col-md-12').addClass('col-md-9');
		$('.form-uploader-wrapper').show();
	});

	mydropzone.on('reset', function(){
		$('.dz-addmore').hide();
		$('.dz-message').show();
		$('.form-uploader-wrapper').hide();
		$('#uploadzone').removeClass('col-md-9').addClass('col-md-12');
	});

	mydropzone.on('success', function(file, response){
		if(response){
			upload_images.push({
				'filename': response.filename,
				'category': null,
				'title': null,
				'description': null,
				'keywords': []
			});	
		}
	});

	mydropzone.on('complete', function(file){
		// console.log(file);
	});

	mydropzone.on('queuecomplete', function(){
		
	});

	$('body').on('click', '.dz-preview', editUploadForm);

	// $('body').not('.dz-preview').on('click', resetUploadForm);
});