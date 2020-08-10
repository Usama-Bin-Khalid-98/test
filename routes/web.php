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
    Route::post('survey', 'SurveyQuestionnaireController@store');
    Route::get('get-campuses', 'CampusController@getCampuses');
 
    Auth::routes(['verify' => true]);
 
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function() {
    return view('auth.login');
});
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Auth::routes(['verify' => true]);
 
    // Only verified users may enter...
    Route::post('business-school', 'BusinessSchoolController@store')->name('business-school');
 
    Route::get('get-cities', 'Auth\RegisterController@get_cities');
    Route::post('business-school', 'BusinessSchoolController@store')->name('business-school');

    Auth::routes(['verify' => true]);
    // Only verified users may enter...
    Route::get('mailsend', 'Auth\RegisterController@mailsend');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('admin', 'DashboardController@index');

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
    Route::resource('invoices','StrategicManagement\SlipController');
    Route::resource('scope','StrategicManagement\ScopeController');
    Route::resource('contact-info','StrategicManagement\ContactInfoController');
    Route::resource('statutory-committees','StrategicManagement\StatutoryCommitteeController');
    Route::resource('affiliations','StrategicManagement\AffiliationController');
    Route::resource('budgetary-info','BudgetaryInfoController');
    Route::resource('strategic-plan','StrategicPlanController');
    Route::resource('print','PrintController');



});


// Curriculum
Route::resource('program-portfolio','ProgramPortfolioController');
Route::resource('entry-requirements','EntryRequirementController');
Route::resource('application-received','ApplicationReceivedController');

// Students
Route::resource('student-enrolment','StudentEnrolmentController');

// Faculty
Route::get('/faculty_summary','Faculty\FacultySummaryController@index')->name('faculty_summary');
Route::get('/visiting_faculty','Faculty\VisitingFacultyController@index')->name('visiting_faculty');
Route::resource('faculty-gender','Faculty\FacultyGenderController');
Route::resource('faculty-stability','Faculty\FacultyStabilityController');
Route::resource('faculty-student-ratio','Faculty\FacultyStudentRatioController');
Route::resource('work-load','Faculty\WorkloadController');
Route::resource('faculty-teaching','Faculty\FacultyTeachingCourcesController');


//research-summary
Route::resource('research-summary','ResearchSummaryController');
 
    // Curriculum
    Route::resource('program-portfolio','ProgramPortfolioController');
    Route::resource('entry-requirements','EntryRequirementController');
    Route::resource('application-received','ApplicationReceivedController');

    // Students
    Route::resource('student-enrolment','StudentEnrolmentController');
    Route::resource('students-graduated','StudentsGraduatedController');
    Route::resource('student-gender','StudentGenderController');

    // Faculty
    Route::get('/faculty_summary','Faculty\FacultySummaryController@index')->name('faculty_summary');
    Route::get('/visiting_faculty','Faculty\VisitingFacultyController@index')->name('visiting_faculty');
    Route::resource('faculty-gender','Faculty\FacultyGenderController');
    Route::resource('faculty-stability','Faculty\FacultyStabilityController');
    Route::resource('faculty-student-ratio','Faculty\FacultyStudentRatioController');
    Route::resource('work-load','Faculty\WorkloadController');
    Route::resource('faculty-teaching','Faculty\FacultyTeachingCourcesController');

    //research-summary
    Route::resource('research-summary','ResearchSummaryController');

    //Facilities-information
    Route::resource('financial-info','FinancialInfoController');
    Route::resource('financial-risk','FinancialRiskController');
    Route::resource('support-staff','SupportStaffController');
    Route::resource('qec-info','QecInfoController');
    Route::resource('business-school-facility','BusinessSchoolFacilityController');
    Route::resource('course-type','CourseTypeController');
    Route::resource('desk-review', 'DeskReviewController');
    Route::resource('nbeac-criteria', 'NbeacCriteriaController');

    //Social-Responsibility
    Route::resource('student-club','StudentClubController');
    Route::resource('project-detail','ProjectDetailController');
    Route::resource('env-protection','EnvProtectionController');
    Route::resource('formal-relationship','FormalRelationshipController');
    Route::resource('complaint-resolution','ComplaintResolutionController');
    Route::resource('internal-community','InternalCommunityController');


   // Route::get('config', 'ConfigController@index')->name('config');
  Route::prefix('config')->group(function (){
//        Route::resource('{table}', 'ConfigController');
//   });

    Route::Get('/{table}', 'ConfigController@index');
    Route::Get('/{table}/create', 'ConfigController@create'); // {user:username}/add
    Route::Post('/{table}', 'ConfigController@store');
    Route::GET('/{table}/edit', 'ConfigController@edit');
    Route::PUT('/{table}/{id}', 'ConfigController@update');
    Route::DELETE('/{table}/{id}', 'ConfigController@destroy');
  });
 
    //Route::get('permission', 'Auth\UserController@permissions');
    Route::group(['middleware' => ['role:NBEACAdmin']], function () {
        ///// Dashboard
        Route::patch('admin/{id}', 'DashboardController@schoolStatus');
        // Users resource route.
        Route::resource('users', 'Auth\UserController');
        // Roles resource route.
        Route::resource('roles', 'Auth\RoleController');
        // Permissions resource route.
        Route::resource('permissions', 'Auth\PermissionController');
        Route::resource('desk-review', 'DeskReviewController');
        Route::resource('nbeac-criteria', 'NbeacCriteriaController');
        Route::resource('department-fee', 'DepartmentFeeController');

    });
//    Route::put('users-roles', 'Auth\UserController\user_roles');

    Route::group(['middleware' => ['role:BusinessSchool']], function () {
    //// Strategic Management
    Route::prefix('strategic')->group(function () {
        Route::resource('basicinfo','StrategicManagement\BasicInfoController');
        Route::resource('invoices','StrategicManagement\SlipController');
        Route::post('generateInvoice','StrategicManagement\SlipController@generateInvoice');
        Route::resource('scope','StrategicManagement\ScopeController');
        Route::resource('contact-info','StrategicManagement\ContactInfoController');
        Route::resource('statutory-committees','StrategicManagement\StatutoryCommitteeController');
        Route::resource('affiliations','StrategicManagement\AffiliationController');
        Route::resource('budgetary-info','BudgetaryInfoController');
        Route::resource('strategic-plan','StrategicPlanController');
        Route::resource('mission-vision','MissionVisionController');
        Route::resource('print','PrintController');
        Route::resource('faculty-degree', 'FacultyDegreeController');

        });
        // Curriculum
        Route::resource('program-portfolio','ProgramPortfolioController');
        Route::resource('entry-requirements','EntryRequirementController');
        Route::resource('application-received','ApplicationReceivedController');

        // Students
        Route::resource('student-enrolment','StudentEnrolmentController');
        Route::resource('students-graduated','StudentsGraduatedController');
        Route::resource('student-gender','StudentGenderController');

        // Faculty
        Route::get('/visiting_faculty','Faculty\VisitingFacultyController@index')->name('visiting_faculty');
        Route::resource('faculty-gender','Faculty\FacultyGenderController');
        Route::resource('faculty-stability','Faculty\FacultyStabilityController');
        Route::resource('faculty-student-ratio','Faculty\FacultyStudentRatioController');
        Route::resource('work-load','Faculty\WorkloadController');
        Route::resource('faculty-teaching','Faculty\FacultyTeachingCourcesController');
        Route::resource('faculty-summary','Faculty\FacultySummaryController');

        //research-summary
        Route::resource('research-summary','ResearchSummaryController');

        //Facilities-information
        Route::resource('financial-info','FinancialInfoController');
        Route::resource('financial-risk','FinancialRiskController');
        Route::resource('support-staff','SupportStaffController');
        Route::resource('qec-info','QecInfoController');
        Route::resource('business-school-facility','BusinessSchoolFacilityController');
        Route::resource('course-type','CourseTypeController');


        //Social-Responsibility
        Route::resource('student-club','StudentClubController');
        Route::resource('project-detail','ProjectDetailController');
        Route::resource('env-protection','EnvProtectionController');
        Route::resource('formal-relationship','FormalRelationshipController');
        Route::resource('complaint-resolution','ComplaintResolutionController');
        Route::resource('internal-community','InternalCommunityController');

    });

    Route::group(['middleware' => ['role:NBEACAdmin']], function () {
    // Route::get('config', 'ConfigController@index')->name('config');
      Route::prefix('config')->group(function (){
        //        Route::resource('{table}', 'ConfigController');
        //   });

        Route::Get('/{table}', 'ConfigController@index');
        Route::Get('/{table}/create', 'ConfigController@create'); // {user:username}/add
        Route::Post('/{table}', 'ConfigController@store');
        Route::GET('/{table}/edit', 'ConfigController@edit');
        Route::PUT('/{table}/{id}', 'ConfigController@update');
        Route::DELETE('/{table}/{id}', 'ConfigController@destroy');
        });

    });
 
 
//Facilities-information
Route::resource('financial-info','FinancialInfoController');
