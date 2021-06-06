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

Route::get('/', 'HomeController@index');

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postLogin','AuthController@postLogin');
Route::post('/register','AuthController@register');
Route::get('/logout','AuthController@logout');

// Admin Panel
Route::group(['middleware' => ['auth','checkRole:1,2,3']], function(){
	// Dashboard
	Route::get('/admin-panel/dashboard','HomeController@dashboard');
	// Roles
	Route::get('/admin-panel/roles','AdminPanel\RolesController@index');
	// UsersManagement - Users Data
	Route::get('/admin-panel/admins','AdminPanel\UsersDataController@admins');
	Route::post('/admin-panel/admins/add','AdminPanel\UsersDataController@addAdmin');
	Route::get('/admin-panel/owners','AdminPanel\UsersDataController@owners');
	Route::post('/admin-panel/owners/add','AdminPanel\UsersDataController@addOwner');
	Route::get('/admin-panel/customers','AdminPanel\UsersDataController@customers');
	// User Configuration
	Route::get('/admin-panel/profile','AdminPanel\UserConfigurationController@profile');
	Route::post('/admin-panel/profile/edit','AdminPanel\UserConfigurationController@editProfile');
	Route::get('/admin-panel/password','AdminPanel\UserConfigurationController@password');
	Route::post('/admin-panel/updatePassword','AdminPanel\UserConfigurationController@updatePassword');

});
?>