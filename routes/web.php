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

Route::get('/home', 'HomeController@index')->name('home');
// get users
Route::get('/user', 'Auth\UserController@index');
Route::post('/users', 'Auth\UserController@index');
//// Strategic Management
Route::post('/strategic_management/basic_info', '@index');
//get permissions
Route::get('/permission', 'Auth\UserController@permissions');
