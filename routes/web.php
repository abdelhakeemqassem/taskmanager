<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Employee\HomeController as EmployeeHomeController;
use App\Http\Controllers\Employee\Auth\LoginController as EmployeeLoginController;
use App\Http\Controllers\Employee\Auth\RegisterController as EmployeeRegisterController;
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
// Auth::routes();

//Admin Routes 
Route::get('/',[HomeController::class, 'index'])->name('admin.home');
Route::prefix('admin')->group(function () {
    Route::get('/',[HomeController::class, 'index'])->name('admin.home');
    Route::get('/logout',[HomeController::class, 'index'])->name('home');
    //Tasks
    Route::get('/tasks', [HomeController::class,'tasks']);
    Route::get('/tasks/show', [TaskController::class,'index']);
    Route::post('/task/create', [TaskController::class,'store']);
    Route::delete('/task/delete/{id}', [TaskController::class,'destroy']);
    Route::put('/task/update/{id}', [TaskController::class,'update']);
    
    //Employees
    Route::get('/employees', [HomeController::class,'employees']);
    Route::get('/employees/show', [EmployeeController::class,'index']);
    Route::post('/employee/create', [EmployeeController::class,'store']);
    Route::delete('/employee/delete/{id}', [EmployeeController::class,'destroy']);
    Route::put('/employee/update/{id}', [EmployeeController::class,'update']);

    //roles
    Route::get('roles', [HomeController::class,'roles']);
    
    //assign task
    Route::get('assigntask/{id}', [HomeController::class,'assigntask']);
    
    // Login
    Route::get('login', [LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class,'login'])->name('admin.login');
    Route::post('logout', [LoginController::class,'logout'])->name('adminlogout');

    // Register
    // Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('admin.register');
    // Route::post('register', [RegisterController::class,'register'])->name('admin.register');

    // Reset Password
    // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // // Confirm Password
    // Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    // Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    // Verify Email
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    // Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    // Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
});


//Employee Routes
// Route::prefix('employee')->group(function () {
//     // Dashboard
//     Route::get('/', [EmployeeHomeController::class,'index'])->name('home');

//     // Login
//     Route::post('login', [EmployeeLoginController::class,'showLoginForm'])->name('employee.login');
//     Route::post('login', [EmployeeLoginController::class,'login']);
//     Route::post('login', [EmployeeLoginController::class,'logout'])->name('employee.logout');
    
//     // Register
//     Route::post('login', [RegisterController::class,'logout'])->name('emp.logout');
//     Route::get('register', [EmployeeRegisterController::class,'showRegistrationForm'])->name('employee.register');
//     Route::post('register', [EmployeeRegisterController::class,'register'])->name('employee.register');

//     // // Reset Password
//     // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//     // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//     // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//     // Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//     // // Confirm Password
//     // Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
//     // Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

//     // Verify Email
//     // Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
//     // Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// //     // Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
// });








