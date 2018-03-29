@extends('layouts/timeline')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')       
    <!-- Section -->
    <link rel="stylesheet" href="{{ url('') }}/css/photo-detail.css">  
    <section class="page-section pt-100 pb-20">
        <div class="relative">
            <div class="row">
                <div class="col-sm-10 col-sm-push-1">
                  <div class="tab-content">
                      <div role="tabpanel" id="post-data" class="tab-pane fade in active">
                        <ul class="works-grid work-grid-gut  clearfix font-alt hide-titles masonry" id="popular-grid" >
                            @foreach($data as $media)
                            <!-- Work Item (Lightbox) -->
                            <li class="work-item mix photography" >
                                <a id="{{ $media->_id }}" href="#" class="mfp-image comment-button">
                                    <div class="work-img">
                                        <img src="{{ url($media['images']['medium']) }}" alt="Work">
                                    </div>
                                </a>
                                <div class="work-intro align-left">
                                    <div class="profile-icon"><img src="{{ $media['user']['photo'] }}"></div>
                                    <h3 class="work-title">{{ $media->getName() }}</h3>
                                </div>
                            </li>
                            <!-- End Work Item -->
                            @endforeach
                        </ul>
                      </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <div class="modal-fs" id="commentPost" data-remodal-id="commentPostModal">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div id="comment-content"></div>
    </div>
    <!-- End Section -->
@endsection

@section('footer_script')
    <script type="text/javascript" src="{{ url('') }}/js/dashboard.js"></script>
@endsection