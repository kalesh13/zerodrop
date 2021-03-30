<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('admin')->group(function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('reset', 'Auth\ResetPasswordController@reset');
    Route::post('forgotPassword', 'Auth\ForgotPasswordController@sendResetLinkEmail');

    Route::get('courses', 'Courses\CourseController@all');
});

Route::prefix('admin')->middleware(['auth.admin'])->group(function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('course', 'Courses\CourseController@create');
    Route::patch('course/{id}', 'Courses\CourseController@update');
    Route::get('course/{id}', 'Courses\CourseController@retreive');
    Route::patch('page/{page}', 'Pages\PageController@update');
    Route::get('page/{page}', 'Pages\PageController@retreive');
});

Route::get('courses', 'Courses\CourseController@all');

Route::middleware('auth:api')->group(function () {
    Route::post('upload', 'FileController@upload');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
