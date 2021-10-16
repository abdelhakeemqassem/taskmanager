<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\Auth\LoginController as EmployeeLoginController;
use App\Http\Controllers\Employee\HomeController as EmployeeHomeController;
// Dashboard
Route::get('/', [EmployeeHomeController::class,'index'])->name('home');
Route::get('/mytasks', [EmployeeHomeController::class,'index']);
Route::get('/tasks/show', [EmployeeHomeController::class,'show']);
 
// Login
Route::get('login', [EmployeeLoginController::class,'showLoginForm'])->name('login');
Route::post('login', [EmployeeLoginController::class,'login'])->name('login');
Route::post('logout', [EmployeeLoginController::class,'logout'])->name('logout');
    
// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
