@extends('layouts/global')

@section('page-title')
Komunitas Fotografi Telkom
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('') }}/css/profiles.css">  
<link rel="stylesheet" href="{{ url('') }}/css/photo-detail.css">  
<section class="page-section pt-80">
	<div class="relative container align-left">
                    
        <div class="row">
            
            <div class="col-md-12">
                <h1 class="hs-line-11 font-alt mt-50 mb-20 mb-xs-0 align-center">Sorry, this page isn't available.</h1>
                <div class="hs-line-4 font-alt black align-center">
                    The link you followed may be broken, or the page may have been removed.
                </div>
                <div class="local-scroll align-center mt-30">                                        
                    <a href="{{ url('/') }}" class="btn btn-mod btn-round btn-small"><i class="fa fa-angle-left"></i> Back To Home Page</a>                                        
                </div>
            </div>
        </div>
        
    </div>
    
	
</section>
@endsection
