$(function(){
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

	mydropzone.on('complete', function(file){
		console.log(file);
	});

	mydropzone.on('queuecomplete', function(){
		
	});
});