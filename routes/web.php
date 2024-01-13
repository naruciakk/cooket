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

Route::get('/', 'TicketController@home');
Route::get('/terms', 'TicketController@terms');

Auth::routes();

Route::group(['middleware' => 'tenant'], function () {

	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

	Route::get('/home', 'User\PanelController@index');
	Route::get('/history', 'HistoryController@index');
	Route::get('/archive', 'TicketController@index');
	Route::get('/archive/{slug}', 'ShowTicketController@index');

	Route::post('/home', 'User\PanelController@save');
	Route::post('/home/password', 'User\PanelController@changePassword');

	//Admin Panel
	Route::get('/users', 'Admin\UserController@index');
	Route::get('/events', 'Admin\EventController@index');
	Route::get('/roles', 'Admin\AdminRoleController@index');
	Route::get('/orgs', 'Admin\OrgController@index');
	Route::get('/orgs/{id}', 'Admin\OrgController@edit');
	Route::get('/orgs/edit/{id}', 'Admin\DatabaseController@edit');
	Route::get('/users/{id}', 'Admin\UserController@edit');
	Route::get('/users/delete/{id}', 'Admin\UserController@delete');
	Route::get('/events/{id}', 'Admin\EventController@edit');
	Route::get('/events/delete/{id}', 'Admin\EventController@delete');
	Route::get('/roles/delete/{id}', 'Admin\AdminRoleController@delete');

	Route::post('/users/{id}', 'Admin\UserController@save');
	Route::post('/events/new', 'Admin\EventController@add');
	Route::post('/events/{id}', 'Admin\EventController@save');
	Route::post('/roles/new', 'Admin\AdminRoleController@add');
	Route::post('/orgs/new', 'Admin\OrgController@add');
	Route::post('/orgs/{id}', 'Admin\OrgController@save');
	Route::post('/orgs/edit/{id}', 'Admin\DatabaseController@save');
	Route::post('/orgs/new/{id}', 'Admin\DatabaseController@add');

	//Org Panel
	//Route::get('/information', 'Org\InformationController@index');
	Route::get('/choose/{id}', 'ChangeController@choose');
	Route::get('/userroles', 'Org\UserRolesController@index');
	Route::get('/transfers', 'Org\TransferController@index');
	Route::get('/transfers/{code}', 'Org\TransferController@confirm');
	Route::get('/guests', 'Org\GuestController@index');
	Route::get('/guests/printing', 'Org\GuestController@printing');
	Route::get('/guests/csving', 'Org\GuestController@generateCSV');
	Route::get('/guests/{id}', 'Org\GuestController@show');
	Route::get('/guests/payments/change/{id}', 'Org\GuestController@change');
	Route::get('/guests/delete/{id}', 'Org\GuestController@delete');
	Route::get('/guests/payments/edit/{id}', 'Org\GuestController@editPayment');
	Route::get('/guests/payments/delete/{id}', 'Org\GuestController@deletePayment');
	Route::get('/tickets', 'Org\TicketController@index');
	Route::get('/tickets/{id}', 'Org\TicketController@edit');
	Route::get('/tickets/delete/{id}', 'Org\TicketController@delete');
	Route::get('/tickets/payments/edit/{id}', 'Org\TicketPaymentController@edit');
	Route::get('/tickets/payments/delete/{id}', 'Org\TicketPaymentController@delete');
	Route::get('/signing', 'Org\SigningController@index');
	Route::get('/signing/add', 'Org\SigningController@add');
	Route::get('/signing/{id}', 'Org\SigningController@show');
	Route::get('/userroles/delete/{id}', 'Org\UserRolesController@delete');
	Route::get('/summary', 'Org\SummaryController@index');
	Route::get('/forms', 'Org\FormController@index');
	Route::get('/forms/{id}', 'Org\FormController@list');
	Route::get('/forms/{type}/{id}', 'Org\FormController@show');

	Route::post('/guests/add', 'Org\GuestController@insert');
	Route::post('/guests/edit/{id}', 'Org\GuestController@save');
	Route::post('/guests/payments/edit/{id}', 'Org\GuestController@savePayment');
	Route::post('/guests/{id}/payments/new', 'Org\GuestController@addPayment');
	Route::post('/guests/delete/{id}', 'Org\GuestController@remove');
	Route::post('/tickets/new', 'Org\TicketController@add');
	Route::post('/tickets/{id}', 'Org\TicketController@save');
	Route::post('/signing/add', 'Org\SigningController@insert');
	Route::post('/signing/{id}', 'Org\SigningController@sign');
	Route::post('/userroles/new', 'Org\UserRolesController@add');
	Route::post('/tickets/payments/edit/{id}', 'Org\TicketPaymentController@save');
	Route::post('/tickets/{id}/payments/new', 'Org\TicketPaymentController@add');

	//Page routing (always at the bottom of the list)
	Route::post('/guest/{slug}', 'GuestSaveController@index');
	Route::get('/{slug}', 'PageController@index');
	Route::get('/{slug}/{sha}', 'ShowTicketController@show');
	Route::post('/{slug}/{sha}', 'ShowTicketController@pinSave');
	Route::get('/{slug}/{sha}/print', 'ShowTicketController@print');
	Route::post('/{slug}/{sha}/photo', 'ShowTicketController@uploadPhoto');
	Route::get('/{slug}/{sha}/{name}', 'ShowTicketController@showForm');
	Route::get('/{slug}/{sha}/{name}/{id}', 'ShowTicketController@showFormAfter');
	Route::get('/{slug}/{sha}/{name}/{id}/edit', 'ShowTicketController@editFormAfter');
	Route::post('/{slug}/{sha}/{name}', 'ShowTicketController@saveForm');
	Route::post('/{slug}/{sha}/{name}/{id}', 'ShowTicketController@saveFormAfter');
	Route::group(['middleware' => 'auth'], function () {
		Route::post('/{slug}', 'GuestSaveController@registered');
	});

});
