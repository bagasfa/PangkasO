<?php

use Illuminate\Support\Facades\Route;

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
// Guest Things
Route::get('/', 'HomeController@index');
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postLogin','AuthController@postLogin');
Route::post('/register','AuthController@register');
Route::get('/logout','AuthController@logout');

// Admin Panel - Universal Things
Route::group(['middleware' => ['auth','checkRole:1,2,3']], function(){
	
	// User Configuration
	Route::get('/admin-panel/profile','AdminPanel\UserConfigurationController@profile');
	Route::post('/admin-panel/profile/update','AdminPanel\UserConfigurationController@updateProfile');
	Route::get('/admin-panel/password','AdminPanel\UserConfigurationController@password');
	Route::post('/admin-panel/updatePassword','AdminPanel\UserConfigurationController@updatePassword');

});

// Admin Panel - Superadmin & Admin Only
Route::group(['middleware' => ['auth','checkRole:1,2']], function(){

	// Admin Dashboard
	Route::get('/admin-panel/dashboard','HomeController@adminDashboard');

	// UsersManagement - Users Data
	// Owner
	Route::get('/admin-panel/owners','AdminPanel\UsersDataController@owners');
	Route::get('/admin-panel/owners/load/table-owner', 'AdminPanel\UsersDataController@LoadTableUsers');
    Route::get('/admin-panel/owners/load/data-owner', 'AdminPanel\UsersDataController@LoadDataOwner');
    Route::get('/admin-panel/owners/delete/{id}', 'AdminPanel\UsersDataController@destroyOwner');
    Route::post('/admin-panel/owners/add', 'AdminPanel\UsersDataController@storeOwner');
    // Customer
	Route::get('/admin-panel/customers','AdminPanel\UsersDataController@customers');
	Route::get('/admin-panel/customers/load/table-customer', 'AdminPanel\UsersDataController@LoadTableUsers');
    Route::get('/admin-panel/customers/load/data-customer', 'AdminPanel\UsersDataController@LoadDataCustomer');
    Route::get('/admin-panel/customers/delete/{id}', 'AdminPanel\UsersDataController@destroyCustomer');
});

// Admin Panel - Superadmin Only
Route::group(['middleware' => ['auth','checkRole:1']], function(){

	// Log History
	Route::get('/admin-panel/activity-history','AdminPanel\HistoryController@history');
	Route::get('/admin-panel/activity-history/load/table-history', 'AdminPanel\HistoryController@LoadTableHistory');
    Route::get('/admin-panel/activity-history/load/data-history', 'AdminPanel\HistoryController@LoadDataHistory');
    
	// Roles
	Route::get('/admin-panel/roles','AdminPanel\RolesController@index');
	Route::get('/admin-panel/roles/load/table-roles', 'AdminPanel\RolesController@LoadTableRoles');
    Route::get('/admin-panel/roles/load/data-roles', 'AdminPanel\RolesController@LoadDataRoles');
    Route::get('/admin-panel/roles/delete/{id}', 'AdminPanel\RolesController@destroy');
    Route::post('/admin-panel/roles/add', 'AdminPanel\RolesController@store');
    Route::post('/admin-panel/roles/update/{id}', 'AdminPanel\RolesController@update');

    // UsersManagement - Users Data
    Route::get('/admin-panel/admins','AdminPanel\UsersDataController@admins');
	Route::get('/admin-panel/admins/load/table-admin', 'AdminPanel\UsersDataController@LoadTableUsers');
    Route::get('/admin-panel/admins/load/data-admin', 'AdminPanel\UsersDataController@LoadDataAdmin');
    Route::get('/admin-panel/admins/delete/{id}', 'AdminPanel\UsersDataController@destroyAdmin');
    Route::post('/admin-panel/admins/add', 'AdminPanel\UsersDataController@storeAdmin');
});

// Admin Panel - Admin Only
Route::group(['middleware' => ['auth','checkRole:2']], function(){

});

// Admin Panel - Owner Only
Route::group(['middleware' => ['auth','checkRole:3']], function(){
	// Owner Dashboard
	Route::get('/owner-panel/dashboard','HomeController@ownerDashboard');
});

?>