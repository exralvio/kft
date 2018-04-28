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
          <!-- /.box-header -->
          <div class="box-body">
            <table id="mediaList" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Content</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($contents as $page)
                <tr id="list-{{ $page->_id }}">
                  <td id="title-{{ $page->_id }}">{{ $page->title }}</td>
                  <td>{{ $page->slug }}</td>
                  <td>{{ $page->content }}</td>
                  <td>
                    <a href="{{ url('admin/page').'/'.$page->_id }}/edit">
                      <div class="action-btn bg-blue">
                          <i class="fa fa-edit"></i> Edit
                      </div>
                    </a>
                    <a data-postId="{{$page->id}}" class="remove-button">
                      <div class="action-btn bg-red">
                          <i class="fa fa-remove"></i> Delete
                      </div>
                    </a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $contents->links() }}
          </div>
          <!-- /.box-body -->
        </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
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
$(function () {
  $('.remove-button').on('click', function(v, k){
    var id = $(this).attr('data-postId');
    var title = $('#title-'+id).html();
    var url = '/admin/media/';
    deleteList(url, id, title);
  })
})
</script>
@endsection