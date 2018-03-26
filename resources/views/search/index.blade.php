@extends('layouts/timeline')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content') 
<style type="text/css">
    .search-image{ height: 275px!important; width: auto;overflow: hidden; margin: 5px;}
    .search-image img{ height: 275px;}
    .search-image-container{ float: left;margin: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box; box-sizing: border-box; }
    #photos {
        /* Prevent vertical gaps */
        line-height: 0;
        
        -webkit-column-count: 4;
        -webkit-column-gap:   0px;
        -moz-column-count:    4;
        -moz-column-gap:      0px;
        column-count:         4;
        column-gap:           5px;
        }

     #photos img {
        /* Just in case there are inline attributes */
        width: 100% !important;
        height: auto !important;
        margin: 5px;
    }

    

    body {
    margin: 0;
    padding: 0;
    }
</style>
<section class="page-section pt-100">
    <!-- <ul class="works-grid work-grid-gut clearfix font-alt hover-white hide-titles" id="work-grid-2"> -->
        <!-- @foreach($data as $result) -->
        <!-- Work Item (External Page) -->
        <!-- <li class="search-image-container mix design photography">
            <a href="#" class="work-ext-link">
                <div class="search-image">
                    <img src="{{ url('').'/'.$result->images['medium'] }}" alt="{{ $result->title }}" />
                </div>
            </a>
        </li> -->
        <!-- End Work Item -->
        <!-- @endforeach -->
    <!-- </ul> -->
    <div id="photos">
    @foreach($data as $result)
    <img src="{{ url('').'/'.$result->images['medium'] }}" alt="{{ $result->title }}" />
    @endforeach
    </div>
</section>
@endsection