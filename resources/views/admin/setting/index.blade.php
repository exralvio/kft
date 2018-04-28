@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
    <h1>
      Settings
      <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Settings</li>
    </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Setting</h3>
            </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="mediaList" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Label</th>
                  <th>Value</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($settings as $setting)
                <tr id="list-{{ $setting->_id }}">
                  <td>{{ $setting->label }}</td>
                  <td>{{ $setting->value }}</td>
                  <td>
                    <a href="{{ url('admin/setting/'.$setting->_id) }}/edit">
                      <div class="action-btn bg-blue">
                          <i class="fa fa-edit"></i> Edit
                      </div>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $settings->links() }}
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