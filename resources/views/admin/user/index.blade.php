@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Users
      <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Users</li>
    </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">List of User</h3>
            <a href="{{ url('admin/user/export') }}" style="float:right;">
              <div class="action-btn bg-blue">
                  <i class="fa fa-file-text"></i> Export
              </div>
            </a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="userList" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Company</th>
                  <th>Department</th>
                  <th>Subsidiaries</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr id="list-{{ $user->_id }}">
                  <td>
                    <div class="img-container">
                      <a href="#" class="zoomable" data-postId="{{ $user->_id }}">
                        @if(!empty($user->photo))
                          <img src="{{ url($user->photo) }}"/>
                        @else
                          -
                        @endif
                      </a>
                      <input id="img-{{ $user->_id }}" type="hidden" value="{{ url($user->photo) }}">
                    </div>
                  </td>
                  <td id="title-{{ $user->_id }}">{{ $user->fullname }}</td>
                  <td id="title-{{ $user->_id }}">{{ $user->email }}</td>
                  <td>{{ ($user->gender == 'F') ? 'Female' : 'Male' }}</td>
                  <td>{{ $user->company }}</td>
                  <td>{{ !empty($user->department['name']) ? $user->department['name'] : '-' }}</td>
                  <td>{{ !empty($user->sister_company['name']) ? $user->sister_company['name'] : '-' }}</td>
                  <td>
                    <a href="{{ url('admin/user').'/'.$user->_id }}/edit">
                      <div class="action-btn bg-blue">
                          <i class="fa fa-edit"></i> Edit
                      </div>
                    </a>
                    <a data-postId="{{$user->id}}" class="remove-button">
                      <div class="action-btn bg-red">
                          <i class="fa fa-remove"></i> Delete
                      </div>
                    </a>
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

  $('.zoomable').on('click', function(){
    $('#zoom-img-container').attr('src','');
    id = $(this).attr('data-postId');
    imgSrc = $('#img-'+id).val();
    $('#zoom-img-container').attr('src',imgSrc);
    var inst = $('[data-remodal-id=zoom-modal]').remodal();
    inst.open();
  });

  $('.remove-button').on('click', function(v, k){
    var id = $(this).attr('data-postId');
    var title = $('#title-'+id).html();
    var url = '/admin/user/';
    deleteList(url, id, title);
  })
})
</script>
@endsection