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

Route::group([
                'middleware' => 'student',
                'prefix' => 'student',
                'namespace' => 'Student'
], function()
{
    Route::get('home', 'BaseController@home');
});


Route::group([
                'middleware' => 'admin',
                'prefix' => 'admin',
                'namespace' => 'Admin'
], function()
{
    Route::get('home', 'BaseController@home');
});
