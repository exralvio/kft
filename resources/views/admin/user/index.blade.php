@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Users
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
                <h3 class="box-title">List of Users</h3>
                <a href="{{ url('admin/user/export') }}" style="float:right;">
                    <div class="action-btn bg-blue">
                        <i class="fa fa-file-text"></i> Export
                    </div>
                </a>
            </div>
            <div class="box-body">
                <table class="table table-bordered" id="user-table">
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
  $('#user-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{!! route('user.data') !!}",
      columns: [
          { data: 'photo',
            name: "photo",
            "render": function ( data, type, row, meta ) {
                    html = "<div class=img-container>";
                    html += "<a href=# class=zoomable data-postId="+row._id+">";
                    html += "<img src={!! url('"+data+"') !!} />";
                    html += "</a>";
                    html += "<input id=img-"+row._id+" type=hidden value={!! url('"+data+"') !!} />";
                    html += "</div>";
                    return html;
                } 
          },
          { data: 'fullname', name: 'fullname' },
          { data: 'email', name: 'email' },
          { data: 'gender', name: 'gender', render: function(d,t,r,m){
              return d == 'F' ? 'Female' : 'Male';
          } },
          { data: 'company', name: 'company' },
          { data: 'department.name', name: 'department' },
          { data: 'sister_company', name: 'sister_company', 
                "render": function(d,t,r,m){
                    return d.name ? d.name : '-'; 
                }
            },
          { data: 'action', name: 'action', orderable: false, searchable: false}
      ]
  });

  $('body').on('click','.remove-button', function(e){
    var id = $(this).attr('data-postId');
    var title = $('#title-'+id).html();
    var url = '/admin/user/';
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