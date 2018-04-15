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
    <!-- start -->
    <section class="page-section pt-80 pb-20">
        <div class="relative">
            <div class="row">
                <div class="col-sm-10 col-sm-push-1">
                  <div id="post-data" class="tab-content discover-grid">
                      <div role="tabpanel" id="popular" class="tab-pane fade in active">
                        <ul class="works-grid work-grid-3 work-grid-gut  clearfix font-alt hide-titles" id="popular-grid" >
                            @if($type == 'photos')
                                 @include('search/media-search')
                            @elseif($type == 'users')
                                @foreach($data as $user)
                                <li class="work-item mix photography" >
                                    <a id="{{ $user->_id }}" href="{{ url('/user').'/'.$user->_id }}" class="mfp-image">
                                        <div class="work-img">
                                            @if(isset($user['photo']))
                                            <img src="{{ url($user['photo']) }}">
                                            @else
                                            <img src="{{ url('') }}/images/pp-icon.png">
                                            @endif
                                        </div>
                                    </a>
                                    <div class="work-intro align-left" style="padding: 15px">
                                        {{ $user['fullname'] }}
                                    </div>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                      </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <!-- end -->

    @include('partials/post-modal')
@endsection

@section('footer_script')
    <script type="text/javascript" src="{{ url('js/discover.js') }}"></script>
@endsection