<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserIsManager;
use App\Http\Middleware\UserIsStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? redirect('dashboard') : redirect('login');
});

Route::get('/account', [UserController::class, 'show'])->name('account');
Route::get('/account/modification', [HomeController::class, 'index'])->name('account_modif');
Route::patch('/account/modification', [HomeController::class, 'updatePassword']);
Route::put('/account/modifier', [HomeController::class, 'updateAccount'])->name('account.update');


Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'someFunction'])->name('dashboard');
    Route::get('students', [StudentController::class, 'students'])->name('global.students');
    Route::resource('/user', UserController::class);
});

Route::middleware(UserIsStudent::class)->group(function () {
    Route::get('/dashboard/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('student/{id}', [StudentController::class, 'show'])->name('student.show');
});

Route::middleware(UserIsManager::class)->group(function () {
    Route::get('/manager', [ImportController::class, 'showImporForm'])->name('manager.index');
    Route::post('/manager/import', [ImportController::class, 'import'])->name('manager.import');
    Route::get('/manager/user', [UserController::class, 'index'])->name('user.index');
    Route::get('teachers', [TeacherController::class, 'index'])->name('manager.teachers');
    Route::resource('company', CompanyController::class);
    Route::resource('teacher', TeacherController::class);
});



