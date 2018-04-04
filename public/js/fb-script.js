window.fbAsyncInit = function() {
    //3f40e541e12a642b9c50bcb67001d918
    FB.init({
        appId      : '1689701714455676',
        cookie     : true,
        xfbml      : true,
        version    : 'v2.12'
    });

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

    FB.AppEvents.logPageView();   
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));