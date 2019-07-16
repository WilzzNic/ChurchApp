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
    return view('welcome');
});

Auth::routes(['verify' => true]);


Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::get('/home', 'HomeController@index')->name('home');

	Route::middleware('can:basic_congregation')->group(function() {
		Route::get('/baptis/request', 'RequestBaptisController@index')->name('bcon.requestbaptis');
		Route::get('/family-altar/request', 'RequestFAController@index')->name('bcon.requestfa');
	});

	Route::middleware('can:expert_congregation')->group(function() {
		
	});

	Route::middleware('can:admin')->prefix('admin')->group(function() {
		
	});

	Route::middleware('can:KAJ_leader')->prefix('kaj-l')->group(function() {
		
	});

	Route::middleware('can:KOM_leader')->prefix('kom-l')->group(function() {
		
	});

	Route::middleware('can:FA_leader')->prefix('fa-l')->group(function() {
		
	});

	Route::middleware('can:PA_leader')->prefix('pa-l')->group(function() {
		
	});

	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

