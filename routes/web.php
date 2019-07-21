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

	
	Route::middleware('can:expert_congregation' || 'can:basic_congregation')->group(function() {
		/* Baptis */
		Route::get('/baptis/request', 'RequestBaptisController@index')->name('bcon.requestbaptis');
		Route::post('/baptis/request/send', 'RequestBaptisController@request')->name('bcon.requestbaptis.send');

		/* Family Altar */
		Route::get('/family-altar/request', 'RequestFAController@index')->name('bcon.requestfa');
		Route::get('/family-altar/dt', 'RequestFAController@populateFA')->name('bcon.altardt');
		Route::post('/family-altar/dt-daerah', 'RequestFAController@populateByDaerah')->name('bcon.altardt.daerah');
		Route::post('/family-altar/send/{id}', 'RequestFAController@request')->name('bcon.requestfa.send');
		Route::delete('/family-altar/leave/{id}', 'RequestFAController@leave')->name('bcon.requestfa.leave');

		/* KOM */
		Route::get('/kom/request', 'RequestKOMController@index')->name('bcon.requestkom');
		Route::post('/kom/request/schedule', 'RequestKOMController@schedule')->name('bcon.requestkom.schedule');
		Route::post('kom/request/send', 'RequestKOMController@request')->name('bcon.requestkom.send');

		/* KAJ */
		Route::get('/kaj/request', 'RequestKAJController@index')->name('bcon.requestkaj');

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

