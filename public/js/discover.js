var popular_limit = 9;
var popular_skip = 0;
var popular_end = false;
var fresh_limit = 9;
var fresh_skip = 0;
var fresh_end = false;
var on_progress = false;
var discover_category = '';

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
    if(fresh_end){
        return;
    }

    var limit = fresh_limit;
    var skip = limit * fresh_skip;

    fresh_skip++;

    $.ajax({
        url: '/loadDiscoverFresh/'+limit+'/'+skip+'/'+discover_category,
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

            if(fresh_skip == 1){
                $('#fresh-grid').css('opacity', 0);

                $("#fresh-grid").justifiedGallery({
                    rowHeight: 256,
                    margins: 10
                });

                 setTimeout(function(){
                    $("#fresh-grid").css('opacity', 1);
                    $('#fresh .load-more').hide();
                }, 500);
            } else {
                $("#fresh-grid").justifiedGallery('norewind');
                $('#fresh .load-more').hide();
            }


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
        url: '/loadDiscoverPopular/'+limit+'/'+skip+'/'+discover_category,
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

            console.log(popular_skip);

            if(popular_skip == 1){
                $('#popular-grid').css('opacity', 0);

                $("#popular-grid").justifiedGallery({
                    rowHeight: 256,
                    margins: 10
                });

                 setTimeout(function(){
                    $("#popular-grid").css('opacity', 1);
                    $('#popular .load-more').hide();
                }, 500);
            } else {
                $("#popular-grid").justifiedGallery('norewind');
                $('#popular .load-more').hide();
            }

            on_progress = false;
        }
    });
}

function changeDiscoverCategory(e){
    e.preventDefault();

    discover_category = $(this).val();

    if($('#popular').hasClass('active')){
        resetPopular();
        loadMorePopular();
    } else if($('#fresh').hasClass('active')){
        resetFresh();
        loadMoreFresh();
    }
}

$(function(){
    loadMorePopular();

    $('.nav-tabs a').on('click', function(e){
        e.preventDefault();
        $(this).tab('show');

        $('.discover-category').val('');
        discover_category = '';

        if($(this).attr('href') == '#fresh'){
            $('.discover-text1').text("The newest uploads");
            $('.discover-text2').text("Be one of the first to discover the photos just added to KFT.");

            resetFresh();
            loadMoreFresh();
        } else if($(this).attr('href') == '#popular'){
            $('.discover-text1').text("What's popular today");
            $('.discover-text2').text("See recently added photos with the highest views.");

            resetPopular();
            loadMorePopular();
        }
    });

    $('.discover-category').on('change', changeDiscoverCategory);
});

$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        if(!on_progress){ 
            if($('#popular').hasClass('active')){
                loadMorePopular();
            } else if($('#fresh').hasClass('active')){
                loadMoreFresh();
            }
        }
    }
});