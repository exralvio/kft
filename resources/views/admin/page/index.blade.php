@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Pages
      <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pages</li>
    </ol>
</section>

<section class="content">
    <div class="row">
      <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Page</h3>
            </div>
            <div class="box-header">
                <a class="pull-right" href="{{ url('admin/page/create') }}">
                <div class="action-btn bg-blue">
                    <i class="fa fa-plus"></i> Add
                </div>
                </a>
            </div>
            <div class="box-body">
              <table class="table table-bordered" id="page-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Content</th>
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
  $('#page-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{!! route('page.data') !!}",
      columns: [
          { data: 'title', name: 'title' },
          { data: 'slug', name: 'slug' },
          { data: 'content', name: 'content' },
          { data: 'action', name: 'action', orderable: false, searchable: false}
      ]
  });

  $('body').on('click','.remove-button', function(e){
    var id = $(this).attr('data-postId');
    var title = $('#title-'+id).html();
    var url = '/admin/page/';
    deleteList(url, id, 'title', this);
  });

});
</script>
@endsection