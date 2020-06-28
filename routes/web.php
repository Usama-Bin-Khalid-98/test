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

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


Auth::routes();

///// Dashboard
Route::get('home', 'HomeController@index')->name('home');
Route::get('admin', function (){
    return view('admin');
});
////// Users permissions
Route::get('permission', 'Auth\UserController@permissions');
// Users resource route.
Route::resource('users', 'Auth\UserController');
// Roles resource route.
Route::resource('roles', 'Auth\RoleController');
// Permissions resource route.
Route::resource('permissions', 'Auth\PermissionController');


//// Strategic Management
Route::get('strategic/basic-info','BasicInfoController@index')->name('basicInfo');
Route::get('/strategic/scope','ScopeController@index')->name('scope');
Route::get('/strategic/contact-info','ContactInfoController@index')->name('contact');
Route::get('/strategic/statutory-committees','ContactInfoController@index')->name('statutory-committees');
Route::get('/strategic/affiliations','AffiliationController@index')->name('affiliations');
Route::get('/strategic/budgetary-information','BudgetaryInfoController@index')->name('budgetaryInfo');
Route::get('/strategic/plan','StrategicPlanController@index')->name('plan');

// Curriculum
Route::get('/portfolio','ProgramPortfolioController@index')->name('portfolio');
Route::get('/entry-requirements','EntryRequirementController@index')->name('entry-requirements');
