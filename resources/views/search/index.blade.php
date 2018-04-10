@extends('layouts/global')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')
<style type="text/css">
    .search-btn{
        width: 5%;
        text-align: center;
        background-color: #0043ff;
    }
    #search-form input, 
    #search-form a, 
    #search-form select{
        height: 50px;
        line-height: 50px;
        font-size: 20px;
        border:1px solid #cfcfcf;
    }
    #search-form select{
        font-size: 12px;
    }
</style>
    <section class="page-section pt-75 pb-20">
        <div class="relative">
            <div class="row">
                <div class="col-md-12">
                    <form id="search-form">
                        <input type="text" style="width:85%;" class="pull-left input-md round form-control" id="q" name="q" placeholder="search"/>
                        <a class="pull-left search-btn"><i class="icon-magnifying-glass"></i></a>
                        <select id="search_param" name="type" style="width:10%;" class="pull-left input-md round form-control">
                            <option value="photos">PHOTO</option>
                            <option value="users">USER</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Section -->
    <section class="page-section pt-0 pb-20">
        <div class="relative">
            <div class="row">
                <div class="col-sm-10 col-sm-push-1">
                  <div class="tab-content">
                      <div role="tabpanel" id="post-data" class="tab-pane fade in active">
                        <ul class="works-grid work-grid-gut  clearfix font-alt hide-titles search-grid" id="popular-grid" >
                            @if($type == 'photos')
                                @foreach($data as $media)
                                <!-- Work Item (Lightbox) -->
                                <li class="work-item mix photography" >
                                    <a data-postid="{{ $media->_id }}" href="#" class="mfp-image comment-button open-single-post">
                                        <div class="work-img">
                                            <img src="{{ url($media['images']['medium']) }}" alt="Work">
                                        </div>
                                    </a>
                                    <div class="work-intro align-left">
                                        <div class="profile-icon"><img src="{{ $media['user']['photo'] }}"></div>
                                        <h3 class="work-title">{{ $media['user']['fullname'] }}</h3>
                                    </div>
                                </li>
                                <!-- End Work Item -->
                                @endforeach
                            @elseif($type == 'users')
                                @foreach($data as $user)
                                <!-- Work Item (Lightbox) -->
                                <li class="work-item mix photography" >
                                    <a id="{{ $user->_id }}" href="{{ url('/profile').'/'.$user->_id }}" class="mfp-image">
                                        <div class="work-img">
                                            @if(isset($user['photo']))
                                            <img src="{{ url($user['photo']) }}">
                                            @else
                                            <img src="{{ url('') }}/images/pp-icon.png">
                                            @endif
                                        </div>
                                    </a>
                                    <div class="work-intro align-left">
                                        {{ $user['fullname'] }}
                                    </div>
                                </li>
                                <!-- End Work Item -->
                                @endforeach
                            @endif

                        </ul>
                      </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

    @include('partials/post-modal')
@endsection