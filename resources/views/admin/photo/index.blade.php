@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Photos
      <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Photos</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Photos</h3>
            </div>
            <div class="box-header">
                <a class="pull-right" href="{{ url('admin/media/create') }}">
                <div class="action-btn bg-blue">
                    <i class="fa fa-plus"></i> Add
                </div>
                </a>
            </div>
            <div class="box-body">
                <table class="table table-bordered" id="photo-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                </table>
            </div>
            </div>
        </div>
    </div>
</section>

<div class="remodal zoom-modal" data-remodal-id="zoom-modal">
<button data-remodal-action="close" class="remodal-close"></button>
<div>
    <img id="zoom-img-container" src="" alt="image"> 
</div>
</div>

@Include('admin/partial/confirm-delete')

@endsection

@section('admin_footer_script')
<script>
$(function() {
  $('#photo-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{!! route('media.data') !!}",
      columns: [
          { data: 'images',
            name: "description",
            "render": function ( data, type, row, meta ) {
                    html = "<div class=img-container>";
                    html += "<a href=# class=zoomable data-postId="+row._id+">";
                    html += "<img src={!! url('"+data.small+"') !!} />";
                    html += "</a>";
                    html += "<input id=img-"+row._id+" type=hidden value={!! url('"+data.large+"') !!} />";
                    html += "</div>";
                    return html;
                } 
          },
          { data: 'title', name: 'title' },
          { data: 'description', name: 'description' },
          { data: 'category.name', name: 'category' },
          { data: 'user.fullname', name: 'user' },
          { data: 'action', name: 'action', orderable: false, searchable: false}
      ]
  });

  $('body').on('click','.remove-button', function(e){
    var id = $(this).attr('data-postId');
    var title = $('#title-'+id).html();
    var url = '/admin/media/';
    deleteList(url, id, 'title', this);
  });

  $('body').on('click','.zoomable', function(e){
    $('#zoom-img-container').attr('src','');
    id = $(this).attr('data-postId');
    imgSrc = $('#img-'+id).val();
    $('#zoom-img-container').attr('src',imgSrc);
    var inst = $('[data-remodal-id=zoom-modal]').remodal();
    inst.open();
  });

  /* $('.zoomable').on('click', function(){
    $('#zoom-img-container').attr('src','');
    id = $(this).attr('data-postId');
    imgSrc = $('#img-'+id).val();
    $('#zoom-img-container').attr('src',imgSrc);
    var inst = $('[data-remodal-id=zoom-modal]').remodal();
    inst.open();
  }); */

});
</script>
@endsection