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

    Route::get('courses', 'CourseController@getCourses');
});

Route::prefix('admin')->middleware(['auth.admin'])->group(function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('imageUpload', 'FilesController@storeImage');
    Route::post('docUpload', 'FilesController@storeDocs');
    Route::post('course', 'CourseController@store');
    Route::patch('course/{id}', 'CourseController@update');
    Route::get('course/{id}', 'CourseController@retreive');
    Route::patch('page/{page}', 'PageController@update');
    Route::get('page/{page}', 'PageController@retreive');
});


Route::get('courses', 'CourseController@getActiveCourses');
Route::get('courses/all/{limit?}', 'CourseController@getAllActiveCourses');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
