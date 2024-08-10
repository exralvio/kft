@extends('admin/layouts/global')

@section('admin-content')
<section class="content-header">
  <h1>
    Today's Statistics
  </h1>
</section>

<section class="content">
  <!-- <div class="row">
    <div class="col-xs-12" style="text-align: center;margin-top: 10%;">
      <img src="{{ url('images/logo-black.png') }}"/>
      <h1>Welcome to KFT Admin Page</h1>
    </div>
  </div> -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-images"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">New Upload Today</span>
          <span class="info-box-number">{{ $todayMedias }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-chatboxes"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">New Comments Today</span>
          <span class="info-box-number">{{ $todayComments }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">New Users Today</span>
          <span class="info-box-number">{{ $todayUsers }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
</section>
@endsection