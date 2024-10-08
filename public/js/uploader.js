var upload_lock = false;
var upload_images = [];
var	first_time = 1;
var upload_index = 0;
var image_counter = 0;
var upload_remodal = $('[data-remodal-id=uploader]').remodal({
	hashTracking: false,
	closeOnEscape: false,
	closeOnOutsideClick: false,
	closeOnCancel: false,
});

function resetUploadForm(){
	$('.form-uploader')[0].reset();
	$('.form-blocker').show();
}

function editUploadForm(e){
	var upload_index = $(this).data('upload-index');
	var data = upload_images[upload_index];

	if(data == null){
		return;
	}

	$('.upload-keywords').tagsinput('destroy');
	$('.upload-keywords').val('');
	$('.upload-keywords').tagsinput();

	$('.dz-preview').removeClass('dz-active');
	$(this).addClass('dz-active');

	$('.form-blocker').hide();
	$('.upload-title').val(data.title);
	$('.upload-description').val(data.description);
	$('.upload-category').val(data.category);
	$('.upload-index').val(upload_index);

	$.each(data.keywords, function(index, value){
		$('.upload-keywords').tagsinput('add', value);
	});

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

	$('.upload-keywords').on('itemAdded itemRemoved', function(e) {
		var current_index = $('.upload-index').val();
		var new_val = $('.upload-keywords').tagsinput('items');
		upload_images[current_index].keywords = new_val;
	});

	$('.upload-category').on('change', function(e){
		var new_val = $(this).val();
		var current_index = $('.upload-index').val();
		upload_images[current_index].category = new_val;
	})
}

function submitUpload(e){
	e.preventDefault();

	/** Update element **/
	$('.form-uploader-wrapper').hide();
	$('#uploadzone').hide();
	$('.upload-publish').show();

	var redirect = $('.form-uploader').data('redirect');

	var active_index = [];
	$('.dz-preview').each(function(i, e){
		if($(e).data('upload-index') != null){
			active_index.push($(e).data('upload-index'));
		}
	});

	var active_images = [];
	$(active_index).each(function(i, v){
		active_images.push(upload_images[v]);
	});

	var datas = {
		"_token": $('meta[name="csrf-token"]').attr('content'),
		"items": active_images
	};

	$.ajax({
		type: 'post',
		url: $('.form-uploader').attr('action'),
		data: datas,
		success: function(response){
			$('.upload-publish').hide();
			$('#uploadzone').show();
			upload_remodal.close();

			setTimeout(function(){
				window.location = redirect;
			}, 1000);
		},
		error: function(){
			alert("Unexpected Error! Please Reload");
			setTimeout(function(){
				// location.reload();
			}, 1000);
		}
	});
}

$(function(){
	$('.upload-btn').on('click', function(e){
		e.preventDefault();
		upload_remodal.open();
	});

	Dropzone.autoDiscover = false;

	var dropzoneOptions = {
		dictDefaultMessage: false,
		addRemoveLinks: false,
		clickable: ".dz-addfile",
		thumbnailWidth: 170,
		thumbnailHeight: 110,
		acceptedFiles: "image/jpeg,image/png",
		timeout: 1800000,
		previewTemplate: document.querySelector('#template-container').innerHTML,
		retryChunks: true,
		retryChunksLimit: 3
	};
	
	var mydropzone = new Dropzone('#uploadzone', dropzoneOptions);

	mydropzone.on('addedfile', function(file){

		$(file.previewElement).data('upload-index', image_counter);
		image_counter++;

		$('.dz-message').hide();
		$('.dz-addmore').show();
		$('#uploadzone').removeClass('col-md-12').addClass('col-md-9');
		$('.form-uploader-wrapper').show();

		upload_images.push({
			'filename': null,
			'category': null,
			'title': null,
			'description': null,
			'keywords': []
		});

		
	});

	mydropzone.on("sending", function(file, xhr, formData) {
		// Will send the filesize along with the file as POST data.
		formData.append("upload_index", upload_index);
		upload_index++;
		upload_lock = true;
		$('.btn-uploader-submit').addClass('disabled');
	});

	mydropzone.on('reset', function(){
		$('.dz-addmore').hide();
		$('.dz-message').show();
		$('.form-uploader-wrapper').hide();
		$('#uploadzone').removeClass('col-md-9').addClass('col-md-12');

		upload_lock = false;
		first_time = 1;
		upload_images = [];
		upload_index = 0;
		image_counter = 0;
	});

	mydropzone.on('success', function(file, response){
		if(response){
			upload_images[response.upload_index].filename = response.filename;

			var newname = '/uploads/preview/'+response.filename; // this is my function
            // changing src of preview element
            file.previewElement.querySelector("img").src = newname;
            $('.dz-new-progress', file.previewElement).addClass('success');

            if(first_time == 1){
				$('.upload-modal .dz-preview').trigger('click');
				first_time = 0;
			}
		}
	});

	mydropzone.on('queuecomplete', function(){
		$('.btn-uploader-submit').removeClass('disabled');
	});

	mydropzone.on('uploadprogress', function(file, progress, bytesSent){
		var progressString = Math.round(progress);
		$('.dz-new-progress-bar', file.previewElement).css('height', progressString+'%');
		$('.dz-new-progress-txt', file.previewElement).text(progressString+'%');
	});

	$('.upload-modal').on('click', '.dz-preview', editUploadForm);

	$('.btn-uploader-submit').on('click', submitUpload);

	$(document).on('cancellation', '.remodal.upload-modal', function (e) {
		if(upload_lock == true){
			if(confirm("Are you sure want to close? All upload will be canceled.")){
				upload_remodal.close();
				mydropzone.removeAllFiles(true)
			}
		} else {
			upload_remodal.close();
		}
	});
});