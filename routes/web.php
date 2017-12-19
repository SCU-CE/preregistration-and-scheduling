<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Auth::routes();
Route::post('/feedback', 'HomeController@post_feedback');

// Student Routes
Route::group([
                'middleware' => 'student',
                'prefix' => 'student',
                'namespace' => 'Student'
], function()
{
    Route::get('home', 'BaseController@home');

    Route::get('passed-courses', 'BaseController@passed_courses');
    Route::post('{course}/pass', 'SemesterController@pass_course');
    Route::post('{course}/unpass', 'SemesterController@unpass_course');

    Route::get('semester-courses', 'BaseController@semester_courses');
    Route::post('{course}/take', 'SemesterController@take_course');
    Route::post('{course}/untake', 'SemesterController@untake_course');

    Route::get('instructor-suggestion', 'BaseController@instructor_suggestion');
    Route::get('{course}/votes', 'SemesterController@voted_instructors');
    Route::post('{course}/vote', 'SemesterController@submit_vote');

    Route::get('evaluate-schedule', 'BaseController@evaluate');
    Route::get('evaluate-schedule/{schedule}/modal', 'EvaluationController@evaluate_lecture_modal');
    Route::resource('evaluation', 'EvaluationController', ['only' => ['store', 'update', 'destroy']]);
    Route::post('evaluation/{evaluation}/upvote/{value}', 'EvaluationController@evaluation_upvote');
    Route::post('evaluation/{evaluation}/downvote/{value}', 'EvaluationController@evaluation_downvote');

    Route::get('final-schedule', 'BaseController@final_schedule');

    Route::get('edit-information', 'StudentController@edit_information');
    Route::patch('update-information', 'StudentController@update_information');
    Route::get('change-password', 'StudentController@change_password');
    Route::patch('update-password', 'StudentController@update_password');

    Route::get('test', function(){
        return DB::table('courses')
                    ->join('course_schedule','courses.id','=','course_schedule.course_id')
                    ->where('course_schedule.semester_id','=',12)
                    ->join('schedule_evaluation','course_schedule.id','=','schedule_evaluation.schedule_id')
                    ->where('session_id','=',1)
                    ->groupBy('courses.id')
                    ->select(DB::raw('courses.id, count(*) as evaluation_count'))
                    ->orderBy('evaluation_count','desc')
                    ->get();
    });
});

// Admin Routes
Route::group([
                'middleware' => 'admin',
                'prefix' => 'admin',
                'namespace' => 'Admin'
], function()
{
    Route::get('home', 'BaseController@home');
    Route::get('courses', 'BaseController@courses');
    Route::get('instructors', 'BaseController@instructors');
    Route::get('semesters', 'BaseController@semesters');
    Route::get('students', 'BaseController@students');
    Route::get('reports', 'BaseController@reports');
    Route::get('query-builder', 'ReportController@create_query');
    Route::resource('query', 'ReportController', ['only' => ['show', 'store', 'edit', 'update', 'destroy']]);
    Route::post('query/{query}/execute', 'ReportController@execute');

    Route::get('scheduling', 'BaseController@scheduling');
    Route::get('scheduling/{course}/information', 'SchedulingController@course_information');
    Route::post('scheduling/store', 'SchedulingController@store_schedule');
    Route::post('scheduling/{course}/destroy', 'SchedulingController@remove_schedule');
    Route::patch('scheduling/schedulingstage', 'SchedulingController@change_scheduling_stage');
    Route::post('scheduling/evaluation-sessions', 'SchedulingController@store_evaluation_sessions');

    Route::get('messages', 'BaseController@messages');
    Route::get('messages/getinbox', 'FeedbackController@getInboxMessages');
    Route::get('messages/getstar', 'FeedbackController@getStarMessages');
    Route::get('messages/getlater', 'FeedbackController@getLaterMessages');
    Route::get('messages/getarchive', 'FeedbackController@getArchiveMessages');
    Route::patch('messages/{feedback}/{state}', 'FeedbackController@changeState');
    Route::delete('messages/{feedback}', 'FeedbackController@destroy');

    Route::get('settings', 'BaseController@settings');
    Route::patch('settings/store', 'OptionController@store_options');
    Route::patch('settings/changepassword', 'OptionController@change_admin_password');
    Route::post('settings/registeradmin', 'OptionController@register_admin');
    Route::delete('settings/{admin}/unregisteradmin', 'OptionController@unregister_admin');

    Route::resource('course', 'CourseController', ['only' => ['store', 'update', 'destroy']]);
    Route::resource('instructor', 'InstructorController', ['only' => ['store', 'update', 'destroy']]);
    Route::resource('semester', 'SemesterController', ['only' => ['show', 'store', 'update', 'destroy']]);
    Route::post('/semester/{semester}/updatecourses', 'SemesterController@update_courses');
    Route::resource('student', 'StudentController', ['only' => ['show', 'destroy']]);
});
