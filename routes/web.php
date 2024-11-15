<?php

use App\Http\Controllers\ActualYearController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\GroupeAnneeController;
use App\Http\Controllers\GroupTDController;
use App\Http\Controllers\GroupTPController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\SeafileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitsController;
use App\Http\Controllers\YearTrainingController;
use App\Http\Middleware\UserIsManager;
use App\Http\Middleware\UserIsStudent;
use App\Http\Middleware\UserIsTeacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? redirect('dashboard') : redirect('login');
});

Route::get('/account', [HomeController::class, 'show'])->name('account');
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
    Route::get('/student', [StudentController::class, 'show'])->name('student.show');
    Route::post('/upload-file', [SeafileController::class, 'uploadFile'])->name('seafile.upload');

});

Route::middleware(UserIsTeacher::class)->group(function () {
    Route::get('/teacher/student', [TeacherController::class, 'showStudents'])->name('teacher.student');
    Route::get('/teacher/visit', [TeacherController::class, 'showVisits'])->name('teacher.visit');
    Route::get('/visits', [VisitsController::class, 'index'])->name('teacher.visit');
    Route::get('/visits/data', [VisitsController::class, 'fetchData']);
    Route::get('/visit/create/{studentId}', [VisitsController::class, 'create'])->name('visit.create');
    Route::post('/visit/store', [VisitsController::class, 'store'])->name('visit.store');
    Route::get('/visit/edit/{id}', [VisitsController::class, 'edit'])->name('visit.edit');
    Route::put('/visit/update/{id}', [VisitsController::class, 'update'])->name('visit.update');

});

Route::middleware(UserIsManager::class)->group(function () {
    Route::get('/manager', [ImportController::class, 'showImporForm'])->name('manager.index');
    Route::post('/manager/import', [ImportController::class, 'import'])->name('manager.import');
    Route::get('/manager/user', [UserController::class, 'index'])->name('user.index');
    Route::get('teachers', [TeacherController::class, 'index'])->name('manager.teachers');
    Route::resource('company', CompanyController::class);
    Route::resource('teacher', TeacherController::class);
    Route::resource('tp_group', GroupTPController::class);
    Route::resource('td_group', GroupTDController::class);
    Route::resource('actual_year', ActualYearController::class);
    Route::resource('year_training', YearTrainingController::class);
    Route::resource('student', StudentController::class);
    Route::resource('tutor', TutorController::class);
    Route::get('/groupes', [GroupeAnneeController::class, 'index'])->name('groupes.index');
    Route::resource('depot', DepotController::class);
    Route::get('/upload', [SeafileController::class, 'upload'])->name('depot.upload');
    Route::post('/upload-file', [SeafileController::class, 'uploadFile'])->name('seafile.upload');
});



