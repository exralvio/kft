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
Route::get('/term-of-service', function(){
	return view('other/term-service');
});
Route::get('/privacy-policy', function(){
	return view('other/privacy-policy');
});

Route::get('/about', 'LandingController@showAbout');

/** Discover **/
Route::get('/discover', 'MediaController@getDiscover');

Route::get('/search', 'SearchController@showSearchResult');
Route::get('/loadMorePost/{mediaId}', 'DashboardController@loadMoreMedia');
Route::get('/loadMedia/{mediaId}', 'DashboardController@loadMedia');

Route::get('/loadDiscoverFresh/{limit?}/{skip?}/{category?}', 'MediaController@loadDiscoverFresh');
Route::get('/loadDiscoverPopular/{limit?}/{skip?}/{category?}', 'MediaController@loadDiscoverPopular');

Route::get('/media/{mediaId}/{json?}', 'MediaController@mediaDetail');

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

	Route::get('/recover-password', 'Auth\ForgotPasswordController@showRecoverPasswordForm');
	Route::post('/recover-password', 'Auth\ForgotPasswordController@sentResetPasswordMail');
	Route::get('/reset-password/{token?}', 'Auth\ResetPasswordController@showResetPasswordForm')->where('token', '(.*)');;
	Route::post('/reset-password', 'Auth\ResetPasswordController@saveResetPassword');
	Route::get('/activate/{token}', 'ActivateController@activate');

	Route::get('/admin/login','Auth\AdminAuthController@showLoginForm');
	Route::post('/admin/login','Auth\AdminAuthController@doLogin');
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

/** user profile **/
Route::get('/user/{user_id}', 'UserController@getProfile');
Route::get('/resendActivation/{email}', 'Auth\AuthController@resendActivationMail');

/** for development purpose only, must be removed later **/
// Route::get('admin/create/{email}/{password}','Auth\AdminAuthController@createAdminUser');


/** Route for admin role */
Route::middleware(['admin'])->prefix('admin')->group(function () {
	Route::get('dashboard', function(){
		return view('admin/dashboard');
	});

	Route::get('logout','Auth\AdminAuthController@doLogout');

	/**
	 * Media
	*/
	Route::get('media/allMedia', 'Backend\MediaController@getMedia');
	Route::delete('media/{id}', ['as'=> 'media.destroy', 'uses'=>'Backend\MediaController@destroy']);
	Route::post('media/{id}', ['as'=> 'media.update', 'uses'=>'Backend\MediaController@update']);
	Route::get('media/{id}/edit', 'Backend\MediaController@edit');
	Route::get('media', 'Backend\MediaController@index');
	Route::get('media/data', ['as'=>'media.data','uses'=>'Backend\MediaController@data']);
	
	/**
	 * User
	 */
	Route::get('user', 'Backend\UserController@index');
	Route::get('user/{id}/edit', 'Backend\UserController@edit');
	Route::get('user/export', 'Backend\UserController@exportToCSV');
	Route::post('user/{id}', ['as'=> 'user.update', 'uses'=>'Backend\UserController@update']);
	Route::delete('user/{id}', ['as'=> 'user.destroy', 'uses'=>'Backend\UserController@destroy']);
	Route::get('user/data', ['as'=>'user.data','uses'=>'Backend\UserController@data']);
	
	/**
	 * User Admin
	*/
	Route::get('user-admin', 'Backend\AdminController@index');
	Route::get('user-admin/{id}/edit', 'Backend\AdminController@edit');
	Route::get('user-admin/create', ['as'=>'useradmin.create','uses'=>'Backend\AdminController@create']);
	Route::post('user-admin/create', ['as'=>'useradmin.store','uses'=>'Backend\AdminController@store']);
	Route::post('user-admin/{id}', ['as'=> 'useradmin.update', 'uses'=>'Backend\AdminController@update']);
	Route::delete('user-admin/{id}', ['as'=> 'useradmin.destroy', 'uses'=>'Backend\AdminController@destroy']);
	Route::get('user-admin/data', ['as'=>'useradmin.data','uses'=>'Backend\AdminController@data']);

	/**
	 * Pages
	*/
	Route::get('page', 'Backend\PageController@index');
	Route::get('page/{id}/edit', 'Backend\PageController@edit');
	Route::get('page/create', ['as'=>'page.create','uses'=>'Backend\PageController@create']);
	Route::get('page/data', ['as'=>'page.data','uses'=>'Backend\PageController@pageData']);
	Route::post('page/create', ['as'=>'page.store','uses'=>'Backend\PageController@store']);
	Route::post('page/{id}', ['as'=> 'page.update', 'uses'=>'Backend\PageController@update']);
	Route::delete('page/{id}', ['as'=> 'page.destroy', 'uses'=>'Backend\PageController@destroy']);

	/**
	 * Settings
	**/
	Route::get('setting', 'Backend\SettingController@index');
	Route::get('setting/{id}/edit', 'Backend\SettingController@edit');
	Route::get('setting/create', ['as'=>'setting.create','uses'=>'Backend\SettingController@create']);
	Route::post('setting/create', ['as'=>'setting.store','uses'=>'Backend\SettingController@store']);
	Route::post('setting/{id}', ['as'=> 'setting.update', 'uses'=>'Backend\SettingController@update']);
	Route::delete('setting/{id}', ['as'=> 'setting.destroy', 'uses'=>'Backend\SettingController@destroy']);
});