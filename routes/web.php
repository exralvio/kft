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


//for testing only, will be removed later
Route::get('/sendMail', 'Auth\AuthController@sendSignUpMail');


Route::middleware('guest')->group(function(){
	/** signup **/
	Route::get('/signup', 'Auth\AuthController@showSignup');
	Route::post('/signup', 'Auth\AuthController@doSignup');
	/** login **/
	Route::get('/login', [ 'as' => 'login', 'uses' => 'Auth\AuthController@showLogin']);
	Route::post('/login', 'Auth\AuthController@doLogin');
});

Route::middleware('auth')->group(function () {
	
	Route::get('user/{id}/profile', function($id){
		echo "id $id";
	});
	
	Route::get('/dashboard', function(){
		return view('dashboard/index');
	});

	Route::get('logout', array('uses' => 'Auth\AuthController@doLogout'));

	/** Media **/
	Route::post('/upload', 'MediaController@postUpload');
});
