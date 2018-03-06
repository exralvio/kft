<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/basic.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/remodal.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/remodal-default-theme.css">

<div class="remodal" data-remodal-id="uploader">
  <form action="{{ url('user/upload')}}" class="dropzone" id="my-awesome-dropzone"></form>
</div>

<script type="text/javascript" src="{{ url('') }}/js/remodal.min.js"></script>
<script type="text/javascript" src="{{ url('') }}/js/dropzone.js"></script>
<script type="text/javascript" src="{{ url('') }}/js/uploader.js"></script>