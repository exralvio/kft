var popular_limit = 9;
var popular_skip = 0;
var popular_end = false;
var fresh_limit = 9;
var fresh_skip = 0;
var fresh_end = false;
var on_progress = false;

function resetFresh(){
    fresh_end = false;
    fresh_skip = 0;
    $('#fresh-grid').empty();
}

function resetPopular(){
    popular_end = false;
    popular_skip = 0;
    $('#popular-grid').empty();
}

function loadMoreFresh(){
    console.log('sampe sini');
    if(fresh_end){
        return;
    }

    console.log('masuk sini');

    var limit = fresh_limit;
    var skip = limit * fresh_skip;

    fresh_skip++;

    $.ajax({
        url: '/loadDiscoverFresh/'+limit+'/'+skip,
        type: 'get',
        beforeSend: function(){
            $('#fresh .load-more').show();
            on_progress = true;
        },
        success: function(response){
            if(response == ''){
                fresh_end = true;
            }

            $('#fresh-grid').append(response);
            $('#fresh .load-more').hide();

            on_progress = false;
        }
    });
}

function loadMorePopular(){
    if(popular_end){
        return;
    }

    var limit = popular_limit;
    var skip = limit * popular_skip;

    popular_skip++;

    $.ajax({
        url: '/loadDiscoverPopular/'+limit+'/'+skip,
        type: 'get',
        beforeSend: function(){
            $('#popular .load-more').show();
            on_progress = true;
        },
        success: function(response){
            if(response == ''){
                popular_end = true;
            }

            $('#popular-grid').append(response);
            $('#popular .load-more').hide();

            on_progress = false;
        }
    });
}

$(function(){
    loadMorePopular();

    $('.nav-tabs a').on('click', function(e){
        e.preventDefault();
        $(this).tab('show');

        if($(this).attr('href') == '#fresh'){
            console.log('masuk ini');
            $('.discover-text1').text("The newest uploads");
            $('.discover-text2').text("Be one of the first to discover the photos just added to KFT.");

            resetFresh();
            loadMoreFresh();
        } else if($(this).attr('href') == '#popular'){
            console.log('masuk popular');
            $('.discover-text1').text("What's popular today");
            $('.discover-text2').text("See recently added photos with the highest views.");

            resetPopular();
            loadMorePopular();
        }
    });
});

$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        console.log(on_progress);
        if(!on_progress){ 
            if($('#popular').hasClass('active')){
                loadMorePopular();
            } else if($('#fresh').hasClass('active')){
                loadMoreFresh();
            }
        }
    }
});