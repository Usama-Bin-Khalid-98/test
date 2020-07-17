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
    // Only verified users may enter...
    Route::post('business-school', 'BusinessSchoolController@store')->name('business-school');
    Route::get('get-cities', 'Auth\RegisterController@get_cities');
    Route::get('mailsend', 'Auth\RegisterController@mailsend');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('admin', 'DashboardController@index');



    ///// Dashboard
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
Route::resource('program-portfolio','ProgramPortfolioController');
Route::resource('entry-requirements','EntryRequirementController');
Route::resource('application-received','ApplicationReceivedController');

// Students
Route::resource('student-enrolment','StudentEnrolmentController');
// Faculty
Route::get('/faculty/workload','WorkLoadController@index')->name('workload');
Route::get('/faculty_cources','FacultyTeachingCources@index')->name('faculty_cources');
Route::get('/visiting_faculty','VisitingFacultyController@index')->name('visiting_faculty');
Route::get('/faculty-gender','FacultyGenderController@index')->name('faculty-gender');
Route::get('/faculty_summary','FacultySummaryController@index')->name('faculty_summary');
Route::get('/faculty_student_ratio','FacultyStudentRatio@index')->name('faculty_student_ratio');
Route::get('/faculty_stability','FacultyStabilityController@index')->name('faculty_stability');


//research-summary
Route::resource('research-summary','ResearchSummaryController');
