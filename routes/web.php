<?php

use App\Http\Controllers\WelcomePageController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BillController;

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\BanUserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SystemProblemController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', [WelcomePageController::class, 'index'])->name('welcome');
Route::get('/our-doctors', [WelcomePageController::class, 'doctor'])->name('doctor');
Route::get('/doctor/{id}', [WelcomePageController::class, 'doctor_show'])->name('doctor.show');
Route::post('/appointments', [WelcomePageController::class, 'appointment_store'])->name('appointments.store')->middleware('auth');

Route::get('/payment/{id}', [WelcomePageController::class, 'payment_page'])->name('payment.page')->middleware('auth');
Route::get('/services', [WelcomePageController::class, 'service'])->name('service');
Route::get('/full-body-health-checkup', [WelcomePageController::class, 'service_page_1'])->name('service_1');
Route::get('/x-ray-scan', [WelcomePageController::class, 'service_page_2'])->name('service_2');
Route::get('/blood-pressure-check', [WelcomePageController::class, 'service_page_3'])->name('service_3');
Route::get('/blood-sugar-test', [WelcomePageController::class, 'service_page_4'])->name('service_4');
Route::get('/full-blood-count-test', [WelcomePageController::class, 'service_page_5'])->name('service_5');
Route::get('/our-appointments', [WelcomePageController::class, 'appointment'])->name('appointment');
Route::get('/contact-us', [WelcomePageController::class, 'contact'])->name('contact');

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


    //Setting Management
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::post('/permissions/delete-selected', [PermissionController::class, 'deleteSelected'])->name('permissions.deleteSelected');
    Route::resource('system_users', SystemUserController::class);
    Route::post('/system-users/{user}/change-password', [SystemUserController::class, 'updatePassword'])->name('system_users.password.update');
   
});

