<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/basic.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/remodal.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/remodal-default-theme.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/bootstrap-tagsinput.css">

<div class="remodal upload-modal" data-remodal-id="uploader">
  <div class="row">
    
  </div>
  <form action="{{ url('upload') }}" class="dropzone pt-20 pd-20 col-sm-12 col-md-12" id="uploadzone">
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
  <div class="col-sm-12 col-md-3 pull-right form-uploader-wrapper">
    <div class="row">
      <form class="form form-uploader pt-20 pd-20 align-left" role="form">
        <div class="col-sm-12">
          <div class="mb-20 mb-md-10 publish-section">
            <button class="btn btn-large btn-uploader-submit">Submit</button>
            <p class="mt-10 mb-10">1 photo to publish</p>
          </div>

          <div class="mb-20 mb-md-10">
            <label>Category</label>
            <select class="form-control input-md">
              <option>Category 1</option>
              <option>Category 2</option>
            </select>
          </div> 
          <div class="mb-20 mb-md-10">
            <label>Title</label>
            <input type="text" class="form-control input-md">
          </div> 
          <div class="mb-20 mb-md-10">
            <label>Description</label>
            <textarea class="form-control input-md"></textarea>
          </div>
          <div class="mb-20 mb-md-10">
            <label>Keywords</label>
            <div>
              <input type="text" name="" data-role="tagsinput">
            </div>
          </div>
        </div>
      </form> 
    </div>
    
  </div>
</div>

<script type="text/javascript" src="{{ url('') }}/js/remodal.min.js"></script>
<script type="text/javascript" src="{{ url('') }}/js/dropzone.js"></script>
<script type="text/javascript" src="{{ url('') }}/js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="{{ url('') }}/js/uploader.js"></script>