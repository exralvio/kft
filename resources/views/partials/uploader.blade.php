<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/basic.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/remodal.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/remodal-default-theme.css">

<div class="remodal upload-modal" data-remodal-id="uploader">
  <form action="{{ url('upload') }}" class="dropzone" id="uploadzone">
  	@csrf
  	<div class="dz-default dz-message">
		<span>
			<a class="btn dz-addfile">Select Photos</a>
			<p>Or drag &amp; drop photos anywhere on this page</p>
		</span>
  	</div>
  	<div class="dz-addmore dz-addfile">
  		<div class="add-more-icon">
  			<i class="fa fa-plus"></i>
  		</div>
  		Add more photos
  	</div>
  </form>
</div>

<script type="text/javascript" src="{{ url('') }}/js/remodal.min.js"></script>
<script type="text/javascript" src="{{ url('') }}/js/dropzone.js"></script>
<script type="text/javascript" src="{{ url('') }}/js/uploader.js"></script>