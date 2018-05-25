@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Photos
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin Users</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Admin User</h3>
                </div>
                <div class="box-header">
                    <a class="pull-right" href="{{ url('admin/user-admin/create') }}">
                    <div class="action-btn bg-blue">
                        <i class="fa fa-plus"></i> Add
                    </div>
                    </a>
                </div>
            <div class="box-body">
                <table class="table table-bordered" id="user-admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin Role</th>
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
  $('#user-admin-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{!! route('useradmin.data') !!}",
      columns: [
          { data: 'fullname', name: 'fullname' },
          { data: 'email', name: 'email' },
          { data: 'admin_role', name: 'admin_role' },
          { data: 'action', name: 'action', orderable: false, searchable: false}
      ]
  });

  $('body').on('click','.remove-button', function(e){
    var id = $(this).attr('data-postId');
    var title = $('#title-'+id).html();
    var url = '/admin/user-admin/';
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

});
</script>
@endsection