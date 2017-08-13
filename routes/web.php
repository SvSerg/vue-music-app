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

Route::get('/', function () {
    return view('index');
});

Route::middleware(['web'])->group(function () {
	Route::post('/api/stream/get', 'StreamController@get');
	Route::post('/api/stream/search', 'StreamController@search');
	Route::post('/api/stream/count-search', 'StreamController@countSearch');
});

Route::middleware(['web', 'auth'])->group(function () {
	Route::post('/api/playlist/add', 'PlaylistController@add');
	Route::post('/api/playlist/get', 'PlaylistController@get');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
