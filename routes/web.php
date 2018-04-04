<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LandingController@showIndex');

/** Discover **/
Route::get('/discover', 'MediaController@getDiscover');

Route::get('/cekSession', function(){
	return Session::get('user');
});

Route::get('/search', 'SearchController@showSearchResult');
Route::get('/loadMorePost/{mediaId}', 'DashboardController@loadMoreMedia');
Route::get('/loadMedia/{mediaId}', 'DashboardController@loadMedia');
Route::get('/media/{mediaId}', 'MediaController@mediaDetail');


/** user profile **/
Route::get('/profile/{user_id}', 'UserController@getProfile');

Route::middleware('guest')->group(function(){
	/** signup **/
	Route::get('/signup', 'Auth\AuthController@showSignup');
	Route::post('/signup', 'Auth\AuthController@doSignup');
	/** login **/
	Route::get('/login', [ 'as' => 'login', 'uses' => 'Auth\AuthController@showLogin']);
	Route::post('/login', 'Auth\AuthController@doLogin');

	Route::get('login/{provider}', 'Auth\AuthController@redirectToProvider');
	Route::get('login/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

	Route::get('/recover-password', 'Auth\ForgotPasswordController@showResetForm');
	Route::post('/recover-password', 'Auth\ForgotPasswordController@recoverPassword');
	Route::get('/sendRecoverMail', 'Auth\ForgotPasswordController@sendRecoverPasswordMail');

	Route::get('/recover-password-mail', function(){
		return view('emails/recover-password-mail');
	});

});

/**
 * User Login but profile not complete
*/
Route::middleware('auth')->group(function () {
	Route::get('user/edit', ['uses'=>'UserController@editProfile']);
	Route::post('user/profile', ['uses'=>'UserController@saveEditProfile']);
	
	Route::get('logout', array('uses' => 'Auth\AuthController@doLogout'));
});

/** User Login and is_active **/
Route::group(['middleware'=>["auth","complete.profile"]],function(){
	Route::get('user/profile', ['uses'=>'UserController@showProfile']);

	Route::get('/dashboard', 'DashboardController@showDashboard');
	Route::post('/postComment', 'DashboardController@postComment');
	Route::post('/deleteComment', 'DashboardController@deleteComment');
	Route::post('/likePost', 'DashboardController@likePost');

	/** notification **/
	Route::get('/loadNotificationContent', 'NotificationController@loadNotificationContent');
	Route::get('/loadUnreadNotification', 'NotificationController@unreadNotification');
	
	/** Media **/
	Route::get('/manage', function(){
		return redirect('manage/all');
	});
	Route::get('/manage/{media_type}', 'MediaController@getManage');

	Route::post('/media/upload', 'MediaController@postUpload');
	Route::post('/media/confirm', 'MediaController@postConfirmUpload');
	Route::post('/media/update', 'MediaController@postUpdateMedia');
	Route::post('/media/remove', 'MediaController@postRemoveMedia');

	Route::post('/user/relation', 'UserController@postRelation');
});