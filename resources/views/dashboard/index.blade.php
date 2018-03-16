@extends('layouts/timeline')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')   
<style type="text/css">
    .timeline-post{
        max-width:480px;
        margin: 0 auto 50px auto;
    }
    .post-container{
        margin-bottom: 10px;
        display: inline-block;
        vertical-align: top;
        margin-left: 5px;
    }
    .poster{
        text-align: left;
        display: table;
        font-weight: bold;
    }
    .published-text, .post-date{
        text-align: left;
        font-size: 10px;
    }
    .poster-pp{
        width: 40px;
        height: 40px;
        border: 1px solid #ccc;
        display: inline-block;
    }
    .category-text{
        font-weight: bold;
    }
</style>

    <section class="page-section pt-100">
        <div class="container relative">
            <div class="col-xs-12 col-lg-10 col-lg-push-1 post-wrapper">
                <!-- <div class="col-xs-12 post-item mb-20">
                    post item 1
                </div> -->
                <div class="row">
                    @foreach($posts as $post)
                    <div class="timeline-post mb-xs-30 wow fadeInUp">
                        <div class="team-item">

                            <div class="poster-pp">
                                <img src="{{ isset($post->user_detail['photo']) ? $post->user_detail['photo'] : url('')/images/pp-icon.png }}"/>
                            </div>
                            <div class="post-container font-alt">
                                <div class="poster">{{ $post->user_detail['first_name'] }} {{ isset($post->user_detail['last_name']) ? $post->user_detail['last_name'] : '' }}</div>
                                <div class="published-text">Published a Gallery 20 Hours Ago</div>
                            </div>
                            
                            <div class="team-item-image">
                                <img src="{{ $post->images['medium'] }}" alt="{{ $post->title }}" />
                                <div class="team-item-detail">
                                    <h4 class="font-alt category-text">{{ isset($post->category_detail['name']) ? $post->category_detail['name'] : '' }}</h4>
                                    <h4 class="font-alt normal">{{ $post->title }}</h4>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                    <!-- End Team item -->
                </div>

            </div>
        </div>
    </section>
@endsection