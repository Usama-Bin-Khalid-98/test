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

Auth::routes(['verify' => true]);
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::post('business-school', 'BusinessSchoolController@store')->name('business-school');
Route::get('get-cities', 'Auth\RegisterController@get_cities');
Route::get('mailsend', 'Auth\RegisterController@mailsend');


Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

Auth::routes();

///// Dashboard
Route::get('home', 'HomeController@index')->name('home');
Route::get('admin', 'DashboardController@index');
Route::patch('admin/{id}', 'DashboardController@schoolStatus');
////// Users permissions
Route::get('permission', 'Auth\UserController@permissions');
// Users resource route.
Route::resource('users', 'Auth\UserController');
// Roles resource route.
Route::resource('roles', 'Auth\RoleController');
// Permissions resource route.
Route::resource('permissions', 'Auth\PermissionController');


//// Strategic Management
Route::prefix('strategic')->group(function () {
    Route::resource('basicinfo','StrategicManagement\BasicInfoController');
    Route::resource('scope','StrategicManagement\ScopeController');
    Route::resource('contact-info','StrategicManagement\ContactInfoController');
    Route::resource('statutory-committees','StrategicManagement\StatutoryCommitteeController');
    Route::resource('affiliations','StrategicManagement\AffiliationController');
    Route::resource('budgetary-information','BudgetaryInfoController');
    Route::resource('plan','StrategicPlanController');

});


// Curriculum
Route::get('/portfolio','ProgramPortfolioController@index')->name('portfolio');
Route::get('/entry-requirements','EntryRequirementController@index')->name('entry-requirements');

// Students
Route::get('/student-enrolment','StudentEnrolmentController@index')->name('student-enrolment');
// Faculty
Route::get('/faculty/workload','WorkLoadController@index')->name('workload');
Route::get('/faculty_stability','StabilityController@index')->name('faculty_stability');
Route::get('/visiting_faculty','VisitingFacultyController@index')->name('visiting_faculty');
Route::get('/faculty-gender','FacultyGenderController@index')->name('faculty-gender');

//research-summary
Route::get('/research-summary','ResearchSummaryController@index')->name('research-summary');
