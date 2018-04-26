@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Users
      <!-- <small>Control panel</small> -->
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
          <!-- /.box-header -->
          <div class="box-body">
            <table id="userList" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Admin Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr id="list-{{ $user->_id }}">
                  <td id="title-{{ $user->_id }}">{{ $user->fullname }}</td>
                  <td id="title-{{ $user->_id }}">{{ $user->email }}</td>
                  <td id="title-{{ $user->_id }}">{{ $user->admin_role }}</td>
                  <td>
                    <a href="{{ url('admin/user-admin').'/'.$user->_id }}/edit">
                      <div class="action-btn bg-blue">
                          <i class="fa fa-edit"></i> Edit
                      </div>
                    </a>
                    @if($user->admin_role != 'Superadmin')
                    <a data-postId="{{$user->id}}" class="remove-button">
                      <div class="action-btn bg-red">
                        <i class="fa fa-remove"></i> Delete
                      </div>
                    </a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $users->links() }}
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
    var url = '/admin/user-admin/';
    deleteList(url, id, title);
  })
})
</script>
@endsection