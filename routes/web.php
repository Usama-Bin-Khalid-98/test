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
    Route::get('get-cities', 'Auth\RegisterController@get_cities');
    Route::post('business-school', 'BusinessSchoolController@store')->name('business-school');

    Auth::routes(['verify' => true]);
    // Only verified users may enter...
    Route::get('mailsend', 'Auth\RegisterController@mailsend');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('admin', 'DashboardController@index');
    Route::get('submitSAR', 'PrintController@submitSAR');

    Route::group(['middleware' => ['auth']], function() {   /// if users not logged in will redirect to login page
        ////// Users permissions
        //Route::get('permission', 'Auth\UserController@permissions');
        Route::group(['middleware' => ['role:NBEACAdmin']], function () {
            ///// Dashboard
            Route::patch('admin/{id}', 'DashboardController@schoolStatus');
            Route::patch('deskReviewReport/{id}', 'DeskReviewController@submitDeskReport');
            Route::patch('SARDeskReviewReport/{id}', 'SARDeskReviewController@submitDeskReport');
            // Users resource route.
            Route::resource('users', 'Auth\UserController');
            Route::post('change-password', 'Auth\UserController@updatePassword')->name('change-password');
            // Roles resource route.
            Route::resource('roles', 'Auth\RoleController');
            // Permissions resource route.
            // Route::resource('permissions', 'Auth\PermissionController');
            Route::resource('desk-review', 'DeskReviewController');
            Route::resource('sar-desk-review', 'SARDeskReviewController');
            Route::get('deskreview/{id?}', 'DeskReviewController@deskreview');
            Route::post('deskreviewStatus', 'DeskReviewController@deskreviewStatus');
            Route::resource('nbeac-criteria', 'NbeacCriteriaController');
            Route::resource('department-fee', 'DepartmentFeeController');


        });
        Route::group(['middleware' => ['role:NBEACAdmin|BusinessSchool|EligibilityScreening|PeerReviewer|ESScheduler|Mentor']], function () {
            Route::resource('print','PrintController');
            Route::resource('registrationPrint','RegistrationPrintController');
            Route::get('registrationPrintPdf','RegistrationPrintController@createPDF');

        });

        //Route::put('users-roles', 'Auth\UserController\user_roles');

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
                Route::resource('sources-funding','SourcesFundingController');
                Route::resource('audit-report','AuditReportController');
                Route::resource('parent-institution','ParentInstitutionController');
            });

    //        Route::resource('print','PrintController');
    //        Route::resource('registrationPrint','RegistrationPrintController');


            // Curriculum
            Route::resource('program-portfolio','ProgramPortfolioController');
            Route::resource('entry-requirements','EntryRequirementController');
            Route::resource('application-received','ApplicationReceivedController');
            Route::resource('curriculum-review','CurriculumReviewController');
            Route::resource('program-objective','ProgramObjectiveController');
            Route::resource('learning-outcome','LearningOutcomeController');
            Route::resource('program-delivery','ProgramDeliveryController');
            Route::resource('question-paper','QuestionPaperController');
            Route::resource('aligned-program','AlignedProgramController');
            Route::resource('course-outline','CourseOutlineController');
            Route::resource('course-detail','CourseDetailController');
            Route::resource('cultural-material','CulturalMaterialController');
            Route::resource('managerial-skill','ManagerialSkillController');
            Route::resource('program-delivery-method','ProgramDeliveryMethodController');
            Route::resource('evaluation-method','EvaluationMethodController');
            Route::resource('plagiarism-case','PlagiarismCaseController');

            // Students
            Route::resource('student-enrolment','StudentEnrolmentController');
            Route::resource('student-intake','StudentIntakeController');
            Route::resource('students-graduated','StudentsGraduatedController');
            Route::resource('student-gender','StudentGenderController');
            Route::resource('class-size','ClassSizeController');
            Route::resource('dropout-percentage','DropoutPercentageController');
            Route::resource('financial-assistance','FinancialAssistanceController');
            Route::resource('student-financial','StudentFinancialController');
            Route::resource('weak-student','WeakStudentController');
            Route::resource('personal-grooming','PersonalGroomingController');
            Route::resource('counselling-activity','CounsellingActivityController');
            Route::resource('student-participation','StudentParticipationController');
            Route::resource('extra-activity','ExtraActivitiesController');
            Route::resource('alumni-membership','AlumniMembershipController');
            Route::resource('alumni-participation','AlumniParticipationController');

            // Faculty
            Route::get('/visiting_faculty','Faculty\VisitingFacultyController@index')->name('visiting_faculty');
            Route::resource('faculty-gender','Faculty\FacultyGenderController');
            Route::resource('faculty-stability','Faculty\FacultyStabilityController');
            Route::resource('faculty-student-ratio','Faculty\FacultyStudentRatioController');
            Route::resource('work-load','Faculty\WorkLoadController');
            Route::resource('faculty-teaching','Faculty\FacultyTeachingCourcesController');
            Route::resource('faculty-summary','Faculty\FacultySummaryController');
            Route::resource('faculty-degree', 'FacultyDegreeController');
            Route::resource('faculty-membership', 'Faculty\FacultyMembershipController');
            Route::resource('international-faculty', 'Faculty\InternationalFacultyController');
            Route::resource('faculty-exposure', 'Faculty\FacultyExposureController');
            Route::resource('faculty-participation', 'Faculty\FacultyParticipationController');
            Route::resource('consultancy-project', 'Faculty\ConsultancyProjectController');
            Route::resource('faculty-promotion', 'FacultyPromotionController');
            Route::resource('faculty-develop', 'FacultyDevelopController');
            Route::resource('faculty-workshop', 'Faculty\FacultyWorkshopController');
            Route::resource('faculty-detailed-info', 'Faculty\FacultyDetailedInfoController');

            //research-summary
            Route::resource('oric','OricController');
            Route::resource('research-center','ResearchCenterController');
            Route::resource('research-agenda','ResearchAgendaController');
            Route::resource('research-funding','ResearchFundingController');
            Route::resource('research-project','ResearchProjectController');
            Route::resource('research-summary','ResearchSummaryController');
            Route::resource('research-output','ResearchOutputController');
            Route::resource('curriculum-role','CurriculumRoleController');
            Route::resource('faculty-development','FacultyDevelopmentController');
            Route::resource('conference','ConferenceController');

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
            Route::resource('social-activity','SocialActivityController');
            Route::patch('registration-apply/{id}','HomeController@apply');
            Route::patch('share-nbeac/{id}','PrintController@applyNBEAC');
            Route::patch('share-mentor/{id}','PrintController@applyMentor');


            //External Linkages & Student Placement
            Route::resource('placement-office','PlacementOfficeController');
            Route::resource('linkages','LinkagesController');
            Route::resource('body-meeting','BodyMeetingController');
            Route::resource('student-exchange','StudentExchangeController');
            Route::resource('faculty-exchange','FacultyExchangeController');
            Route::resource('obtained-internship','ObtainedInternshipController');
            Route::resource('placement-activity','PlacementActivityController');

            //Admission & Examination Policy
            Route::resource('admission-office','AdmissionOfficeController');
            Route::resource('credit-transfer','CreditTransferController');
            Route::resource('student-transfer','StudentTransferController');
            Route::resource('documentary-evidence','DocumentaryEvidenceController');

            Route::resource('eligibility-screening-report','Eligibility\SchoolEligibilityReportController');
            

        });
    
        Route::group(['middleware' => ['role:NBEACAdmin']], function () {
         Route::get('mentoringInvoices', 'MentoringInvoiceController@mentoringInvoices');
          Route::Post('approvementStatus', 'StrategicManagement\SlipController@approvementStatus');
          Route::Post('MentoringInvoiceStatus', 'MentoringInvoiceController@approvementStatus');
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


        Route::group(['middleware' => ['role:ESScheduler|PeerReviewer']], function () {
            Route::get('esScheduler-all', 'EligibilityScreeningController@schedule');
            Route::get('esScheduler/{id}', 'EligibilityScreeningController@schedule');
            Route::get('getAllEvents', 'EligibilityScreeningController@show');
            Route::get('getReviewerAllEvents', 'EligibilityScreeningController@getReviewerAllEvents');
            Route::post('esNotifyAll', 'EligibilityScreeningController@esNotifyAll');
            Route::resource('PRAvailability', 'ReviewerAvailabilityController');
            Route::post('changeConfirmStatus', 'EligibilityScreeningController@changeConfirmStatus');
            Route::get('esReport/{id}', 'EligibilityScreeningController@esReport');
            Route::get('PeerReviewerReport', 'EligibilityScreeningController@esReport');
            Route::post('PeerReviewerReport', 'EligibilityScreeningController@store');
            Route::patch('PeerReviewerReport/{id}', 'EligibilityScreeningController@update');
        });

        Route::group(['middleware' => ['role:ESScheduler|PeerReviewer|NBEACAdmin']], function () {
            Route::get('deskreview/{id?}', 'DeskReviewController@deskreview');

        });

        Route::group(['middleware' => ['role:NBEACAdmin|BusinessSchool']], function () {
            Route::get('invoicesList', 'StrategicManagement\SlipController@invoicesList');
            Route::get('mentoring-invoices', 'MentoringInvoiceController@index');
            Route::get('strategic/invoice/{id}','StrategicManagement\SlipController@invoice');
            Route::get('mentoringInvoice/{id}','MentoringInvoiceController@invoice');
            Route::post('generateMentoringInvoice','MentoringInvoiceController@generateInvoice');
            Route::put('updateMentoringInvoice/{id}','MentoringInvoiceController@update');

        });

        Route::group(['middleware' => ['role:ESScheduler|BusinessSchool']], function () {
            Route::resource('MentoringScheduler', 'ScheduleMentorMeetingController');
            Route::post('changeMentorConfirmStatus', 'ScheduleMentorMeetingController@changeConfirmStatus');

        });
//
        Route::group(['middleware' => ['role:Mentor|BusinessSchool']], function () {
            Route::post('mentorsAvailability', 'ScheduleMentorMeetingController@mentorsAvailability');

        });

        Route::group(['middleware' => ['role:Mentor|ESScheduler|BusinessSchool']], function () {
            Route::get('meetingsList/{id?}', 'ScheduleMentorMeetingController@index');
            Route::get('getMentoringAllEvents', 'ScheduleMentorMeetingController@getMentoringAllEvents');
        });

        Route::group(['middleware' => ['role:Mentor']], function () {
            Route::resource('mentorReport', 'MentoringReportController');
        });
    });
