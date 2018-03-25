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
Route::get('/discover', function(){
	return view('media/discover');
});

Route::middleware('guest')->group(function(){
	/** signup **/
	Route::get('/signup', 'Auth\AuthController@showSignup');
	Route::post('/signup', 'Auth\AuthController@doSignup');
	/** login **/
	Route::get('/login', [ 'as' => 'login', 'uses' => 'Auth\AuthController@showLogin']);
	Route::post('/login', 'Auth\AuthController@doLogin');
});

/**
 * User Login but profile not complete
*/
Route::middleware('auth')->group(function () {
	
	Route::prefix('user')->group(function () {
		Route::get('profile', ['uses'=>'UserController@showProfile']);
		Route::post('profile', ['uses'=>'UserController@saveEditProfile']);
	});
	
	Route::get('logout', array('uses' => 'Auth\AuthController@doLogout'));
});

/** User Login and profile complete **/
Route::group(['middleware'=>["auth","complete.profile"]],function(){

	Route::get('/dashboard', 'DashboardController@showDashboard');
	Route::get('/loadMorePost/{mediaId}', 'DashboardController@loadMoreMedia');
	Route::get('/loadCommentPage/{mediaId}', 'DashboardController@loadCommentPage');
	Route::post('/postComment', 'DashboardController@postComment');
	Route::post('/deleteComment', 'DashboardController@deleteComment');
	
	/** Media **/
	Route::post('/upload', 'MediaController@postUpload');
	Route::post('/confirmUpload', 'MediaController@postConfirmUpload');
	Route::get('/manage', 'MediaController@getManage');
	Route::post('/updateMedia', 'MediaController@postUpdateMedia');
});