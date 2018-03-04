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

Route::get('/login', 'LandingController@showLogin');
Route::post('/login', 'LandingController@doLogin');

Route::get('/signup', 'LandingController@showSignup');
