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

Route::get('/login', 'Auth\AuthController@showLogin');
Route::post('/login', 'Auth\AuthController@doLogin');

//for testing only, will be removed later
Route::get('/sendMail', 'Auth\AuthController@sendMail');

Route::get('logout', array('uses' => 'Auth\AuthController@doLogout'));

Route::get('/signup', 'Auth\AuthController@showSignup');
Route::post('/signup', 'Auth\AuthController@doSignup');


Route::get('/dashboard', function(){
	return view('dashboard/index');
});

/** Media **/
Route::post('/upload', 'MediaController@postUpload');
