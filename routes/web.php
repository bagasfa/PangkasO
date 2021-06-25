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
Route::post('/delete-account','AuthController@deleteAccount');

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

	// Log History
	Route::get('/admin-panel/history','AdminPanel\HistoryController@history');
	Route::get('/admin-panel/history/load/table-history', 'AdminPanel\HistoryController@LoadTableHistory');
    Route::get('/admin-panel/history/load/data-history', 'AdminPanel\HistoryController@LoadDataHistory');
	    
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

    // UsersManagement - Verify Identity
    // Owners
    Route::get('/admin-panel/verify-owners','AdminPanel\VerifyUsersController@owners');
    // Customers
    Route::get('/admin-panel/verify-customers','AdminPanel\VerifyUsersController@customers');
    // Verifying
    Route::get('/admin-panel/verify/approve/{id}','AdminPanel\VerifyUsersController@approve');
    Route::get('/admin-panel/verify/reject/{id}','AdminPanel\VerifyUsersController@reject');
    
});

// Admin Panel - Superadmin Only
Route::group(['middleware' => ['auth','checkRole:1']], function(){

	
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

// Owner Panel - Owner Only
Route::group(['middleware' => ['auth','checkRole:3']], function(){
	// Owner Dashboard
	Route::get('/owner-panel/dashboard','HomeController@ownerDashboard');
	Route::get('/owner-panel/get-verify','AdminPanel\UserConfigurationController@getVerify');
	Route::post('/owner-panel/send-verify','AdminPanel\UserConfigurationController@putVerify');

	// Setup new Barbershop
	Route::get('/owner-panel/setup-barbershop','AdminPanel\BarbershopController@setup');
	Route::post('/owner-panel/update-barbershop','AdminPanel\BarbershopController@update');
	Route::get('/owner-panel/setting-barbershop','AdminPanel\BarbershopController@setting');

	// Banner Management
	Route::get('/owner-panel/banner','AdminPanel\BarbershopController@banner');
	Route::post('/owner-panel/banner/update','AdminPanel\BarbershopController@bannerUpdate');

	// Hairstyle Management
	Route::get('/owner-panel/hairstyle/male','AdminPanel\HairstyleController@male');
	Route::get('/owner-panel/hairstyle/female','AdminPanel\HairstyleController@female');
	Route::post('/owner-panel/hairstyle/add','AdminPanel\HairstyleController@add');
	Route::get('/owner-panel/hairstyle/edit/{id}','AdminPanel\HairstyleController@edit');
	Route::post('/owner-panel/hairstyle/update/{id}','AdminPanel\HairstyleController@update');
	Route::get('/owner-panel/hairstyle/delete/{id}','AdminPanel\HairstyleController@destroy');

	// Service Preferences
	Route::get('/owner-panel/service-pref','AdminPanel\BarbershopController@servicePref');
	Route::post('/owner-panel/service-pref/update','AdminPanel\BarbershopController@servicePrefUpdate');
});

?>