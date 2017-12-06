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
    Route::get('scheduling', 'BaseController@scheduling');
    Route::get('messages', 'BaseController@messages');
    Route::get('settings', 'BaseController@settings');

    Route::resource('course', 'CourseController', ['only' => ['store', 'update', 'destroy']]);
    Route::resource('instructor', 'InstructorController', ['only' => ['store', 'update', 'destroy']]);
    Route::resource('semester', 'SemesterController', ['only' => ['show', 'store', 'update', 'destroy']]);
    Route::post('/semester/{semester}/updatecourses', 'SemesterController@update_courses');
    Route::resource('student', 'StudentController', ['only' => ['show', 'destroy']]);
});
