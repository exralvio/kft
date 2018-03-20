@extends('layouts/timeline')
 
@section('page-title')
 Komunitas Fotografi Telkom
@endsection

@section('content')   
<style type="text/css">
    .timeline-post{
        max-width:650px;
        margin: 0 auto 50px auto;
        background: #ffffff;
        -webkit-box-shadow: 0px 1px 10px 1px rgba(230,230,230,1);
        -moz-box-shadow: 0px 1px 10px 1px rgba(230,230,230,1);
        box-shadow: 0px 1px 10px 1px rgba(230,230,230,1);
    }
    .post-header{
        padding: 10px;
    }
    .post-container{
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
        display: inline-block;
    }
    .poster-pp img {
        border-radius: 50px;
    }
    .category-text{
        font-weight: bold;
    }
    .post-footer{
        padding: 10px;
    }
    .ajax-load{
        background: transparent;
        padding: 10px 0px;
        width: 100%;
    }
    a.button-rounded{
        border: 1px solid #ccc;
        margin: 2px;
        border-radius: 15px;
        padding: 5px 15px;
        text-decoration: none;
        cursor: pointer;
    }
    .blue-sky-bg{
        background-color: #0099e5;
        color: #ffffff;
        font-weight: bold;
        border:none!important;
    }
    .blue-sky-bg:hover{
        background-color: #1fb5ff;
        color: #ffffff;
    }
    .team-item-image {
        margin: 0 5px;
    }
    .post-description{
        margin-top:10px;
    }
    .post-title{
        font-weight: bold;
    }
</style>

<section class="page-section pt-100">
    <div class="container relative">
        <div class="col-xs-12 col-lg-10 col-lg-push-1 post-wrapper">

            <div class="row" id="post-data">
                @include('dashboard/single-post')
            </div>

            <!-- Ajax Loader -->
            <div class="text-center ajax-load"  style="display:none">
                <p><img src="{{url('')}}/images/ajax-loader.gif">Loading More post</p>
            </div>

        </div>
    </div>
</section>

<script type="text/javascript">
    window.onload = function(){
        var prev_id = null;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                var last_id = $(".timeline-post:last").attr("id");
                console.log(prev_id+' = '+last_id, prev_id == last_id);
                // if(prev_id != last_id){
                //     prev_id = last_id;
                    loadMoreData(last_id);
                // }
            }
        });
    
    
        function loadMoreData(last_id){
            var timer = setTimeout(function(){
                clearTimeout(timer);
                $.ajax({
                    url: '/loadMorePost/'+last_id,
                    type: "get",
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data)
                {
                    $('.ajax-load').hide();
                    $("#post-data").append(data);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('failed to connect to server ...');
                });
            },800);
        }
    } 
</script>
@endsection

