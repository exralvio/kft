$(function(){
	Dropzone.autoDiscover = false;

	var dropzoneOptions = {
		dictDefaultMessage: false,
		addRemoveLinks: true,
		clickable: ".dz-addfile"
	};
	
	var mydropzone = new Dropzone('#uploadzone', dropzoneOptions);

	mydropzone.on('addedfile', function(file){
		$('.dz-message').hide();
		$('.dz-addmore').show();
	});

	mydropzone.on('reset', function(){
		$('.dz-addmore').hide();
		$('.dz-message').show();
	});

	mydropzone.on('queuecomplete', function(){
		
	});
});