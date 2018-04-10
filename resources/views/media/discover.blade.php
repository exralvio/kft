@extends('layouts/global')
 
@section('page-title')
 Discover
@endsection
     
@section('content')
    <!-- Section -->
    <section class="small-section mt-80 bg-white pb-0 discover-tablist">
        <div class="relative container align-left">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <h1 class="hs-line-11 font-alt mb-20 mb-xs-0 discover-text1">What's popular today</h1>
                    <div class="hs-line-4 font-alt black discover-text2">
                        See recently added photos with the highest views.
                    </div>
                </div>
            </div>
        </div>
        <div class="relative container align-left mt-50">
            <div class="row">
                <div class="col-xs-12">
                    <div class="pull-right">
                        <form class="form">
                            {{ Form::select('discover_category', App\Models\MediaCategory::pluck('name', '_id'), null, ['placeholder'=>'Category', 'class'=>'input-md form-control discover-category']) }}
                            
                        </form>
                    </div>

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#popular">Popular</a></li>
                        <li ><a href="#fresh">Fresh</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

    <!-- Section -->
    <section class="page-section pt-20 pb-20">
        <div class="relative">
            <div class="row">
                <div class="col-sm-10 col-sm-push-1">
                  <div id="post-data" class="tab-content discover-grid">
                      <div role="tabpanel" id="popular" class="tab-pane fade in active">
                        <ul class="works-grid work-grid-3 work-grid-gut  clearfix font-alt hide-titles" id="popular-grid" >
                        </ul>
                        <div class="load-more">
                            <img src="{{ url('images/load-more.gif') }}">
                        </div>
                      </div>
                      <div role="tabpanel" id="fresh" class="tab-pane fade ">
                        <ul class="works-grid work-grid-3 work-grid-gut clearfix font-alt hide-titles" id="fresh-grid" >
                        </ul>
                        <div class="load-more">
                            <img src="{{ url('images/load-more.gif') }}">
                        </div>
                      </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
    
    @include('partials/post-modal')
@endsection

@section('footer_script')
    <script type="text/javascript" src="{{ url('js/discover.js') }}"></script>
@endsection