<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for user authentication related
| endpoints like login, logout, register, email verification, password reset etc.
|
*/

Route::get('login', 'Admin\AdminController@renderLogin')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

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

Route::get('/', 'Pages\PageController@home');
Route::get('/about', 'Pages\PageController@about');
Route::get('/contact', 'Pages\PageController@contact');
Route::get('/courses', 'Courses\CourseController@renderAll');
Route::get('/course/{id}/{title?}', 'Courses\CourseController@renderCourse');

Route::post('/contact', 'Tickets\TicketController@create');
Route::post('/subscribe', 'Subscribers\SubscriberController@subscribe');
Route::get('/unsubscribe', 'Subscribers\SubscriberController@unsubscribe');

/*
|--------------------------------------------------------------------------
| Administrator Routes
|--------------------------------------------------------------------------
|
| Register the web routes for your administrator backend here.
|
 */
Route::prefix('admin')->middleware(['admin.guest'])->group(function () {
    Route::get('login', 'Admin\AdminController@renderLogin')->name('admin.login');
    Route::get('signup', 'Admin\AdminController@renderRegister')->name('admin.register');
});

Route::prefix('admin')->middleware(['auth.admin'])->group(function () {
    Route::get('page/seed', 'Pages\PageController@seed');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('/{page?}', 'Admin\AdminController@renderDashboard');
    Route::get('/{page?}/{id?}/{sub_page?}/{sub_id?}', 'Admin\AdminController@renderDashboard');
});
