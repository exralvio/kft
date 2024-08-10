@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Announcement
      <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Announcement</li>
    </ol>
</section>

<section class="content">

    @if(Session::has('save_success'))
      <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Save Success!</h4> {{ Session::get('save_success') }}
      </div>
    @endif
    
    <div class="row">
      <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Announcement</h3>
            </div>
            <div class="box-header">
                <a class="pull-right" href="{{ url('admin/announcement/create') }}">
                <div class="action-btn bg-blue">
                    <i class="fa fa-plus"></i> Add
                </div>
                </a>
            </div>
            <div class="box-body">
              <table class="table table-bordered" id="announcement-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Action</th>
                    </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
    </div>
</section>
@Include('admin/partial/confirm-delete')

@endsection

@section('admin_footer_script')
<script>
$(function() {
  $('#announcement-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{!! route('announcement.data') !!}",
      columns: [
          { data: 'title', name: 'title' },
          { data: 'start_date', name: 'start_date', defaultContent: "<b class='text-danger'>not set</b>" },
          { data: 'end_date', name: 'end_date', defaultContent: "<b class='text-danger'>not set</b>" },
          { data: 'action', name: 'action', orderable: false, searchable: false}
      ]
  });

  $('body').on('click','.remove-button', function(e){
    var id = $(this).attr('data-postId');
    var title = $('#title-'+id).html();
    var url = '/admin/announcement/';
    deleteList(url, id, 'title', this);
  });

});
</script>
@endsection