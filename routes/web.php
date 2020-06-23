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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function() {
    return view('auth.login');
});

Auth::routes();

///// Dashboard
Route::get('home', 'HomeController@index')->name('home');
////// Users permissions
Route::get('permission', 'Auth\UserController@permissions');
// Users resource route.
Route::resource('users', 'Auth/UserController');
// Roles resource route.
Route::resource('roles', 'Auth/RoleController');
// Permissions resource route.
Route::resource('permissions', 'Auth/PermissionController');


//// Strategic Management
Route::post('strategic_management/basic_info', '@index');
