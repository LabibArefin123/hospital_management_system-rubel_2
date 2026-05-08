<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\RoleController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', [FrontendController::class, 'index'])->name('welcome');
Route::get('/our-doctors', [FrontendController::class, 'doctor'])->name('doctor');
Route::get('/doctor/{id}', [FrontendController::class, 'doctor_show'])->name('doctor.show');
Route::post('/appointments', [FrontendController::class, 'appointment_store'])->name('appointments.store')->middleware('auth');

Route::get('/payment/{id}', [FrontendController::class, 'payment_page'])->name('payment.page')->middleware('auth');
Route::post('/payment-store', [FrontendController::class, 'payment_store'])->name('payment.store')->middleware('auth');;
Route::get('/service', [FrontendController::class, 'service'])->name('service');
Route::get('/service/{id}', [FrontendController::class, 'service_show'])->name('service.show');
Route::get('/our-appointments', [FrontendController::class, 'appointment'])->name('appointment');
Route::get('/contact-us', [FrontendController::class, 'contact'])->name('contact');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
Route::post('/logout-user', [GoogleController::class, 'logout'])->name('user.logout');

Route::get('/my-profile', function () {
    return view('frontend.profile');
})->middleware('auth')->name('frontend.profile');

require __DIR__ . '/auth.php';
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');


Route::group(['middleware' => 'auth'], function () {
    // Profile Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/global-search', [DashboardController::class, 'globalSearch'])->name('global.search');
    Route::get('/search/result', [DashboardController::class, 'searchResult'])->name('search.result');

    Route::get('/user_profile', [ProfileController::class, 'user_profile_show'])->name('user_profile_show');
    Route::get('/user_profile_edit', [ProfileController::class, 'user_profile_edit'])->name('user_profile_edit');
    Route::put('/user_profile_edit', [ProfileController::class, 'user_profile_update'])->name('user_profile_update');

    Route::resource('doctors', DoctorController::class);
    Route::resource('doctor-schedules', DoctorScheduleController::class);
    Route::resource('services', ServiceController::class);
    Route::get( 'appointments/cancel/{id}', [AppointmentController::class, 'appointment_cancel'])->name('appointments.cancel');
    Route::resource('appointments', AppointmentController::class);


    //Setting Management
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::post('/permissions/delete-selected', [PermissionController::class, 'deleteSelected'])->name('permissions.deleteSelected');
    Route::resource('system_users', SystemUserController::class);
    Route::post('/system-users/{user}/change-password', [SystemUserController::class, 'updatePassword'])->name('system_users.password.update');
   
});

