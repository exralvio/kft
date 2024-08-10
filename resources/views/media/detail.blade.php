@extends('layouts/global')

@section('header_script')
<meta property="fb:app_id" content="1689701714455676" />
<meta property="og:site_name" content="KFT"/>
<meta property="og:url" content="{{ url('media').'/'.$post->_id }}"/>
<meta property="og:type" content="article"/>
<meta property="og:locale" content="id_ID"/>
<meta property="og:title" content="{{ $post->title }}"/>
<meta property="og:image" content="{{ url($post['images']['large']) }}"/>
<meta property="og:description" content="{{ $post->description }}"/>

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@KFT">
<meta name="twitter:title" content="{{ $post->title }}">
<meta name="twitter:description" content="{{ $post->description }}">
<meta name="twitter:image" content="{{ url($post['images']['large']) }}">
<meta name="twitter:domain" content="kft.id">

@endsection

@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content') 

<section class="pt-80" style="background-color: #fff;">
    <div id="media-single">
        @include('media/single')
    </div>
</section>

@endsection
