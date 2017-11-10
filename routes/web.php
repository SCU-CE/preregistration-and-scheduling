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

Route::post('/feedback', 'RootController@sendFeedback');

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function(){
    Route::get('home', 'BaseController@home');

    Route::get('courses', 'BaseController@courses');
    Route::get('semesters', 'BaseController@semesters');
    Route::get('students', 'BaseController@students');
    Route::get('options', 'BaseController@options');
    Route::get('feedback', 'BaseController@feedback');

    Route::get('feedback/statistics', 'FeedbackController@getFeedbackStatistics');

    Route::get('feedback/getinbox', 'FeedbackController@getInboxMessages');
    Route::get('feedback/getstar', 'FeedbackController@getStarMessages');
    Route::get('feedback/getlater', 'FeedbackController@getLaterMessages');
    Route::get('feedback/getarchive', 'FeedbackController@getArchiveMessages');

    Route::patch('feedback/{feedback}/{state}', 'FeedbackController@changeState');
    Route::delete('feedback/{feedback}', 'FeedbackController@destroy');

    Route::resource('course' ,'CourseController');
    Route::resource('semester' ,'SemesterController');
    Route::resource('student' ,'StudentController');

    Route::get('courses/table', 'CourseController@coursesTable');
    Route::get('students/table', 'StudentController@studentsTable');

    Route::get('student/{student}/courses' ,'StudentController@showCourses');

    Route::post('/semester/{semester}/offerall', 'SemesterController@offerAllCourses');
    Route::delete('/semester/{semester}/withdrawall', 'SemesterController@withdrawAllCourses');

    Route::get('/semester/{semester}/courses', 'SemesterController@courses');
    Route::patch('/semester/{semester}/{course}', 'CourseController@updateMinCapacity');
    Route::post('/semester/{semester}/{course}', 'SemesterController@offerCourse');
    Route::delete('/semester/{semester}/{course}', 'SemesterController@withdrawCourse');

    Route::patch('options/store', 'OptionController@storeOptions');
    Route::patch('options/changepassword', 'OptionController@changeAdminPassword');
    Route::post('options/registeradmin', 'OptionController@registerNewAdmin');
    Route::delete('options/{admin}/unregisteradmin', 'OptionController@unregisterAdmin');
});

Route::group(['middleware' => 'student', 'prefix' => 'student', 'namespace' => 'Student'], function(){
    Route::get('home', 'BaseController@home');

    Route::get('preregister', 'SemesterController@preRegisterForm');
    Route::get('paasedcourses', 'SemesterController@passedCoursesForm');

    Route::post('{course}/pass', 'SemesterController@passCourse');
    Route::post('{course}/unpass', 'SemesterController@unpassCourse');

    Route::post('{course}/take', 'SemesterController@takeCourse');
    Route::post('{course}/untake', 'SemesterController@untakeCourse');

    Route::get('editinfo', 'StudentController@editInformationForm');
    Route::get('changepass', 'StudentController@changePasswordForm');

    Route::patch('editinfo/submit', 'StudentController@editInformation');
    Route::patch('changepass/submit', 'StudentController@changePassword');
});
