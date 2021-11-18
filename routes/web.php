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


// Auth Things
	// Login
	Route::get('/login', 'Auth\AuthController@login')->name('login');
	Route::post('/postLogin','Auth\AuthController@postLogin');
	// Register
	Route::post('/register','Auth\AuthController@register');
	Route::post('/registerCustomer','Auth\AuthController@registerCustomer');
	// Logout
	Route::get('/logout','Auth\AuthController@logout');
	// Forgot Password
	Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
	// Delete Account
	Route::post('/delete-account','Auth\AuthController@deleteAccount');

// Guest Pages
	// Homepage
	Route::get('/', 'HomeController@index');
	// Barbershop Pages
	Route::get('/barbershop','CustomerPages\BarbershopController@barbershop');
	Route::get('/barbershop/{url}','CustomerPages\BarbershopController@url');
	// Selected Hairstyle
	Route::get('/barbershop/{url}/{id}','CustomerPages\HairstyleController@selectedHairstyle');

	// Hairstyle Pages
	Route::get('/hairstyle','CustomerPages\HairstyleController@hairstyle');
	Route::get('/hairstyle/search','HomeController@search');
	Route::get('/hairstyle/male','CustomerPages\HairstyleController@maleHairstyle');
	Route::get('/hairstyle/female','CustomerPages\HairstyleController@femaleHairstyle');

	// Urutan Pesanan
	Route::get('/orders/{url}','CustomerPages\TransactionController@orderList');


// Admin Panel - Universal Things
Route::group(['middleware' => ['auth','checkRole:1,2,3']], function(){
	
	// User Configuration
	Route::get('/admin-panel/profile','AdminPanel\UserConfigurationController@profile');
	Route::post('/admin-panel/profile/update','AdminPanel\UserConfigurationController@updateProfile');
	Route::get('/admin-panel/password','AdminPanel\UserConfigurationController@password');
	Route::post('/admin-panel/updatePassword','AdminPanel\UserConfigurationController@updatePassword');

	// Export Transaction
	Route::get('/transactions/export/excel','AdminPanel\TransactionController@excel');

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
	// Barbershop Data Management
	Route::get('/admin-panel/barbershop','AdminPanel\BarbershopController@barbershop');
	Route::get('/admin-panel/barbershop/load/table-barbershop', 'AdminPanel\BarbershopController@LoadTableBarbershop');
    Route::get('/admin-panel/barbershop/load/data-barbershop', 'AdminPanel\BarbershopController@LoadDataBarbershop');
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

    // Transaction History
    Route::get('/admin-panel/transactions/history','AdminPanel\TransactionController@historyAdmin');
	Route::get('/admin-panel/transactions/load/table-transaksi', 'AdminPanel\TransactionController@LoadTableTransaksi');
    Route::get('/admin-panel/transactions/load/data-transaksi', 'AdminPanel\TransactionController@LoadDataTransaksi');
    Route::get('/admin-panel/transactions/delete/{id}', 'AdminPanel\TransactionController@destroy');
    
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

// Owner Panel - Owner Only
Route::group(['middleware' => ['auth','checkRole:3']], function(){
	// Owner Dashboard
	Route::get('/owner-panel/dashboard','HomeController@ownerDashboard');

	// Order List
	Route::get('/owner-panel/orders','AdminPanel\TransactionController@orders');
	Route::get('/owner-panel/orders/confirm/{id}','AdminPanel\TransactionController@confirm');
	Route::get('/owner-panel/orders/reject/{id}','AdminPanel\TransactionController@reject');
	Route::post('/owner-panel/orders/cancel/','AdminPanel\TransactionController@close');
	Route::get('/owner-panel/orders/cancel/{id}','AdminPanel\TransactionController@cancel');
	Route::get('/owner-panel/orders/complete/{id}','AdminPanel\TransactionController@complete');

	// Orders History
	Route::get('/owner-panel/orders/history','AdminPanel\TransactionController@history');
	Route::get('/owner-panel/transactions/load/table-transaksi', 'AdminPanel\TransactionController@LoadTableTransaksi');
    Route::get('/owner-panel/transactions/load/data-transaksi', 'AdminPanel\TransactionController@LoadDataTransaksiBarber');

	// Verify Identity
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

// Customers Things
Route::group(['middleware' => ['auth','checkRole:4']], function(){

	// Pending Counter
	Route::get('/pending-counter','HomeController@pendingCounter');

	// Customer Configuration (Update Profile & Password)
	Route::get('/profile','CustomerPages\CustomerConfigurationController@profile');
	Route::post('/profile/update','CustomerPages\CustomerConfigurationController@updateProfile');
	Route::post('/password/update','CustomerPages\CustomerConfigurationController@updatePassword');

	// Verifikasi
	Route::get('/verify','CustomerPages\CustomerConfigurationController@getVerify');
	Route::post('/verify/send-verify','CustomerPages\CustomerConfigurationController@putVerify');

	// Order (Proses Transaksi)
	Route::post('/order','CustomerPages\TransactionController@order');

	// Rate Hairstyle After Order Complete
	Route::post('/rating/hairstyle/{id}', 'CustomerPages\RatingController@hairstyle');
	Route::post('/rating/barbershop/{id}', 'CustomerPages\RatingController@barbershop');

	// Order List
	Route::get('/orders','CustomerPages\TransactionController@showOrders');
	Route::get('/orders/history','CustomerPages\TransactionController@history');
	Route::get('/orders/cancel/{id}','CustomerPages\TransactionController@cancel');
	Route::get('/orders/abort/{id}','CustomerPages\TransactionController@abort');

	// Aktivitas
	Route::get('/activity','CustomerPages\CustomerConfigurationController@activity');

});

?>