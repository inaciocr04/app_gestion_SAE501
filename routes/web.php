<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? redirect('home') : redirect('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home.index');
    })->name('home');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'someFunction'])->name('dashboard');
});

Route::get('student/{id}', [UserController::class, 'show'])->name('student.show');

Route::get('/manager', [ImportController::class, 'showImporForm'])->name('manager.index');
Route::post('/manager/import', [ImportController::class, 'import'])->name('manager.import');
Route::get('/manager/students', [StudentController::class, 'students'])->name('manager.students');
