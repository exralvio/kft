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
            <h3 class="box-title">Data Table With Full Features</h3>
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
                <tr>
                  <td>image</td>
                  <td>title</td>
                  <td>Description</td>
                  <td>category</td>
                  <td>fullname</td>
                  <td>
                    <div class="action-btn-bg" style="background-color: #346bb0;cursor: pointer;height: 20px;float: left;padding: 0px 10px;border-radius: 5px;color: #fff;">
                      <i class="fa fa-edit"></i>Edit
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection

@section('admin_footer_script')
<script>
$(function () {
  $('#mediaList').DataTable({
    ordering: false
  });
  console.log($('#mediaList'));
})
</script>
@endsection