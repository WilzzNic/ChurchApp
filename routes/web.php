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
})->middleware('guest');

Route::get('/guest/kom/request', 'Guest\RequestKOMController@index')->name('guest.kom.request.index');
Route::post('/guest/kom/schedule', 'Guest\RequestKOMController@schedule')->name('guest.kom.request.schedule');
Route::post('/guest/kom/request/send', 'Guest\RequestKOMController@request')->name('guest.kom.request.send');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
	// Route::get('/home', 'HomeController@index')->name('home');
	
	Route::middleware(['can:basic_congregation' || 'can:FA_leader'])->group(function() {
		/* Baptis */
		Route::get('/baptis/request', 'RequestBaptisController@index')->name('bcon.requestbaptis');
		Route::post('baptis/request/schedule', 'RequestBaptisController@scheduleExclude')->name('bcon.requestbaptis.schedule.exclude');
		Route::post('/baptis/request/send', 'RequestBaptisController@request')->name('bcon.requestbaptis.send');
		Route::delete('/baptis/request/delete/{id}', 'RequestBaptisController@delete')->name('bcon.requestbaptis.delete');

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
		Route::delete('/kom/request/delete/{id}', 'RequestKOMController@delete')->name('bcon.requestkom.delete');

		/* KAJ */
		Route::get('/kaj/request', 'RequestKAJController@index')->name('bcon.requestkaj');
		Route::get('/kaj/request/send', 'RequestKAJController@request')->name('bcon.requestkaj.send');
		Route::delete('/kaj/request/delete/{id}', 'RequestKAJController@delete')->name('bcon.requestkaj.delete');

	});

	Route::middleware('can:admin')->prefix('admin')->group(function() {
		/* Verifikasi Baptis */
		Route::get('manage/baptis/index', 'Admin\DataVerificationController@indexBaptis')->name('admin.manage.baptis.index');
		Route::get('manage/baptis/dt', 'Admin\DataVerificationController@dtBaptis')->name('admin.manage.baptis.dt');
		Route::get('manage/baptis/show/{id}', 'Admin\DataVerificationController@imgBaptis')->name('admin.manage.baptis.img');
		Route::put('manage/baptis/validate/{id}', 'Admin\DataVerificationController@validateBaptis')->name('admin.manage.baptis.validate');
		Route::put('manage/baptis/invalidate/{id}', 'Admin\DataVerificationController@invalidateBaptis')->name('admin.manage.baptis.invalidate');

		/* Verifikasi KOM */
		Route::get('manage/kom/index', 'Admin\DataVerificationController@indexKom')->name('admin.manage.kom.index');
		Route::get('manage/kom/dt', 'Admin\DataVerificationController@dtKom')->name('admin.manage.kom.dt');
		Route::get('manage/kom/show/{id}', 'Admin\DataVerificationController@imgKom')->name('admin.manage.kom.img');
		Route::put('manage/kom/validate/{id}', 'Admin\DataVerificationController@validateKom')->name('admin.manage.kom.validate');
		Route::put('manage/kom/invalidate/{id}', 'Admin\DataVerificationController@invalidateKom')->name('admin.manage.kom.invalidate');

		/* Verifikasi KAJ */
		Route::get('manage/kaj/index', 'Admin\DataVerificationController@indexKaj')->name('admin.manage.kaj.index');
		Route::get('manage/kaj/dt', 'Admin\DataVerificationController@dtKaj')->name('admin.manage.kaj.dt');
		Route::get('manage/kaj/show/{id}', 'Admin\DataVerificationController@imgKaj')->name('admin.manage.kaj.img');
		Route::put('manage/kaj/validate/{id}', 'Admin\DataVerificationController@validateKaj')->name('admin.manage.kaj.validate');
		Route::put('manage/kaj/invalidate/{id}', 'Admin\DataVerificationController@invalidateKaj')->name('admin.manage.kaj.invalidate');

		/* Verifikasi Jemaat */
		Route::get('manage/jemaat/index', 'Admin\DataVerificationController@indexJemaat')->name('admin.manage.jemaat.index');
		Route::get('manage/jemaat/dt', 'Admin\DataVerificationController@dtJemaat')->name('admin.manage.jemaat.dt');
		Route::put('manage/jemaat/validate/{id}', 'Admin\DataVerificationController@validateJemaat')->name('admin.manage.jemaat.validate');
		Route::put('manage/jemaat/invalidate/{id}', 'Admin\DataVerificationController@invalidateJemaat')->name('admin.manage.jemaat.invalidate');

		/* Manajemen Family Altar */
		Route::get('manage/altar/index', 'Admin\ManageFAController@index')->name('admin.manage.fa.index');
		Route::get('manage/altar/dt', 'Admin\ManageFAController@dtAltar')->name('admin.manage.fa.dt');
		Route::post('manage/altar/add', 'Admin\ManageFAController@add')->name('admin.manage.fa.add');
		Route::get('manage/altar/edit/{id}', 'Admin\ManageFAController@edit')->name('admin.manage.fa.edit');
		Route::put('manage/altar/update/{id}', 'Admin\ManageFAController@update')->name('admin.manage.fa.update');
		Route::delete('manage/altar/delete/{id}', 'Admin\ManageFAController@delete')->name('admin.manage.fa.delete');

		/* Manajemen Pimpinan */
		Route::get('manage/leader/index', 'Admin\ManageLeaderController@index')->name('admin.manage.leader.index');
		Route::get('manage/leader/dt', 'Admin\ManageLeaderController@dt')->name('admin.manage.leader.dt');
		Route::post('manage/leader/add', 'Admin\ManageLeaderController@add')->name('admin.manage.leader.add');
		Route::delete('manage/leader/delete/{id}', 'Admin\ManageLeaderController@delete')->name('admin.manage.leader.delete');
	});

	Route::middleware('can:superadmin')->prefix('superadmin')->group(function() {
		/* Manajemen Daerah */
		Route::get('manage/daerah/index', 'Superadmin\DaerahController@index')->name('superadmin.manage.daerah');
		Route::get('manage/daerah/dt', 'Superadmin\DaerahController@dt')->name('superadmin.manage.daerah.dt');
		Route::post('manage/daerah/tambah', 'Superadmin\DaerahController@add')->name('superadmin.manage.daerah.add');
		Route::delete('manage/daerah/{id}/delete', 'Superadmin\DaerahController@delete')->name('superadmin.manage.daerah.delete');

		/* Manajemen Cabang Gereja */
		Route::get('manage/cabang/index', 'Superadmin\CabangGerejaController@index')->name('superadmin.manage.cabang');
		Route::get('manage/cabang/dt', 'Superadmin\CabangGerejaController@dt')->name('superadmin.manage.cabang.dt');
		Route::post('manage/cabang/add', 'Superadmin\CabangGerejaController@add')->name('superadmin.manage.cabang.add');
		Route::delete('manage/cabang/delete/{id}', 'Superadmin\CabangGerejaController@delete')->name('superadmin.manage.cabang.delete');

		/* Manajemen Admin */
		Route::get('manage/admin/index', 'Superadmin\ManageAdminController@index')->name('superadmin.manage.admin');
		Route::get('manage/admin/dt', 'Superadmin\ManageAdminController@dt')->name('superadmin.manage.admin.dt');
		Route::post('manage/admin/add', 'Superadmin\ManageAdminController@add')->name('superadmin.manage.admin.add');
		Route::delete('manage/admin/delete/{id}', 'Superadmin\ManageAdminController@delete')->name('superadmin.manage.admin.delete');

		/* Statistik dan Data */
		Route::get('statistics/index', 'Superadmin\StatisticsController@index')->name('superadmin.statistic.index');
		Route::get('statistics/jemaat/dt', 'Superadmin\StatisticsController@dtJemaat')->name('superadmin.statistic.jemaat.dt');
	});

	Route::middleware(['can:KAJ_leader' || 'can:KOM_leader' || 'can:FA_leader' || 'can:baptis_leader'])->prefix('leader')->group(function() {
		Route::get('/request-list', 'LeadersController@show')->name('leader.request.show');
		Route::get('/request-list/dt', 'LeadersController@showDt')->name('leader.request.show.dt');
		Route::post('/request-list/approve/{id}', 'LeadersController@approve')->name('leader.request.approve');
		Route::post('/request-list/approvebaptis', 'LeadersController@forBaptis')->name('leader.approve.baptis');
		Route::post('/request-list/reject/{id}', 'LeadersController@reject')->name('leader.request.reject');
		Route::get('/statistics', 'StatisticsController@index')->name('leader.statistic.index');
		Route::get('/statistics/jemaat/dt', 'StatisticsController@jemaatDt')->name('leader.statistic.jemaat.dt');

		Route::get('/request-approved', 'LeadersController@approvedIndex')->name('leader.request.approved.index');
		Route::get('/request-approved/dt', 'LeadersController@approvedDt')->name('leader.request.approved.dt');
		
		/* Enrolling List for KOM */
		Route::get('/kom-enrolling', 'LeadersController@enrollingKOMIndex')->name('leader.kom.enrolling.index');
		Route::get('/kom-enrolling/dt', 'LeadersController@enrollingKOMDt')->name('leader.kom.enrolling.dt');
		Route::put('/kom-enrolling/complete/{id}', 'LeadersController@completeKOM')->name('leader.kom.enrolling.complete');
	});

	Route::middleware('can:baptis_leader')->prefix('co-baptis')->group(function() {{
		/* Manajemen Jadwal Baptis */
		Route::get('/jadwal/index', 'LeaderBaptis\ManageJadwalController@index')->name('leader.baptis.jadwal.index');
		Route::get('/jadwal/dt', 'LeaderBaptis\ManageJadwalController@dt')->name('leader.baptis.jadwal.dt');
		Route::post('/jadwal/add', 'LeaderBaptis\ManageJadwalController@add')->name('leader.baptis.jadwal.add');
		Route::delete('/jadwal/delete/{id}', 'LeaderBaptis\ManageJadwalController@delete')->name('leader.baptis.jadwal.delete');
	}});

	Route::middleware('can:KOM_leader')->prefix('co-kom')->group(function() {
		/* Manajemen Jadwal KOM */
		Route::get('/jadwal/index', 'LeadersController@indexJadwalKOM')->name('leader.kom.jadwal.index');
		Route::get('/jadwal/dt', 'LeadersController@dtJadwalKOM')->name('leader.kom.jadwal.dt');
		Route::post('/jadwal/add', 'LeadersController@addJadwalKOM')->name('leader.kom.jadwal.add');
		Route::delete('/jadwal/delete/{id}', 'LeadersController@deleteJadwalKOM')->name('leader.kom.jadwal.delete');

		/* Inbox Guest */
		// Route::get('/guest/request-list', 'LeaderKOM\ManageRequestController@indexPending')->name('leader.guest.request.pending.index');
		// Route::get('/guest/request-list/dt', 'LeaderKOM\ManageRequestController@pendingDt')->name('leader.guest.request.pending.dt');
		// Route::get('/guest/kom-enrolling', 'LeaderKOM\ManageRequestController@indexEnrolling')->name('leader.guest.kom.enrolling.index');
		// Route::get('/guest/kom-enrolling/dt', 'LeaderKOM\ManageRequestController@enrollingDt')->name('leader.guest.kom.enrolling.dt');
		// Route::get('/guest/kom-completed', 'LeaderKOM\ManageRequestController@indexCompleted')->name('leader.guest.kom.completed.index');
		// Route::get('/guest/kom-completed/dt', 'LeaderKOM\ManageRequestController@completedDt')->name('leader.guest.kom.completed.dt');
		// Route::put('/guest/request-list/approve/{id}', 'LeaderKOM\ManageRequestController@approvePending')->name('leader.guest.request.pending.approve');
		// Route::delete('/guest/request-list/reject/{id}', 'LeaderKOM\ManageRequestController@rejectPending')->name('leader.guest.request.pending.reject');
		// Route::put('/guest/kom-enrolling/complete/{id}', 'LeaderKOM\ManageRequestController@complete')->name('leader.guest.kom.enrolling.complete');
	});

	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

