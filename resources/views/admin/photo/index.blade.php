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
          <!-- /.box-header -->
          <div class="box-body">
            <table id="mediaList" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>image</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>User</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($medias as $media)
                <tr id="list-{{ $media->_id }}">
                  <td>
                    <div class="img-container">
                      <img src="{{ !empty($media->images['small']) ? url($media->images['small']) :url($media->images['medium']) }}"/>
                    </div>
                  </td>
                  <td id="title-{{ $media->_id }}">{{ $media->title }}</td>
                  <td>{{ $media->description }}</td>
                  <td>category</td>
                  <td>{{ $media->user['fullname'] }}</td>
                  <td>
                  <a href="{{ url('admin/media').'/'.$media->_id }}">
                    <div class="action-btn bg-blue">
                        <i class="fa fa-edit"></i> Edit
                    </div>
                  </a>
                  <a data-postId="{{$media->id}}" class="remove-button">
                    <div class="action-btn bg-red">
                        <i class="fa fa-remove"></i> Delete
                    </div>
                  </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $medias->links() }}
          </div>
          <!-- /.box-body -->
        </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

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