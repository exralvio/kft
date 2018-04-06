<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/basic.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/remodal.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/remodal-default-theme.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/bootstrap-tagsinput.css">

<div class="remodal upload-modal" data-remodal-id="uploader">
  <div class="row">
    
  </div>
  <form action="{{ url('media/upload') }}" class="dropzone pt-20 pd-20 col-sm-12 col-md-12" id="uploadzone">
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
      <form class="form form-uploader pt-20 pd-20 align-left" role="form" action="{{ url('media/confirm') }}" data-redirect="{{ url('manage/all') }}">
        <div class="form-blocker"></div>
        <div class="col-sm-12">
          <div class="mb-20 mb-md-10 publish-section">
            <button class="btn btn-large btn-uploader-submit">Submit</button>
            <p class="mt-10 mb-10">1 photo to publish</p>
          </div>

          <div class="mb-20 mb-md-10">
            <label>Category</label>
            {{ Form::select('department', App\Models\MediaCategory::pluck('name', '_id'), null, ['placeholder'=>'Uncategorized', 'class'=>'input-md form-control upload-category']) }}
          </div> 
          <div class="mb-20 mb-md-10">
            <label>Title</label>
            <input type="text" placeholder="Untitled" class="form-control input-md upload-title">
          </div> 
          <div class="mb-20 mb-md-10">
            <label>Description</label>
            <textarea placeholder="None" class="form-control input-md upload-description"></textarea>
          </div>
          <div class="mb-20 mb-md-10">
            <label>Keywords</label>
            <div>
              <input class="upload-keywords" type="text" name="" data-role="tagsinput">
            </div>
          </div>
          <input type="hidden" class="upload-index" name="">
        </div>
      </form> 
    </div>
  </div>

  <div class="col-sm-12 upload-publish">
    <h5 class="mt-sm-30 mt-lg-50">Publishing</h5>
    <img src="{{ url('images/rolling.gif') }}">
  </div>

</div>

<script type="text/javascript" src="{{ url('') }}/js/dropzone.js"></script>
<script type="text/javascript" src="{{ url('') }}/js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="{{ url('') }}/js/uploader.js"></script>