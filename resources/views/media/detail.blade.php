@extends('layouts/global')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content') 
<link rel="stylesheet" href="{{ url('') }}/css/photo-detail.css">  

<section class="pt-80" style="background-color: #fff;">
    <div id="comment-content">
        @include('dashboard/comment')
    </div>
</section>

@endsection

@section('footer_script')
<script type="text/javascript" src="{{ url('') }}/js/dashboard.js"></script>
@endsection

