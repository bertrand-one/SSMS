<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('register');
});
Route::post('/register.post', [AuthController::class, 'register']);


Route::get('/login', function () {
    return view('login');
})->name("login");
Route::post('/login.post',[AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout']);


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('students',[StudentController::class, 'index']);
Route::post('students.add',[StudentController::class, 'addstudent']);

Route::get('/courses',[CourseController::class, 'index']);
Route::post('/course.add',[CourseController::class, 'addcourse']);

Route::get('/attendance/{id}',[AttendanceController::class, 'index']);
Route::post('/attendance', [AttendanceController::class, 'store']);

Route::get('/grades/{id}',[GradesController::class, 'index']);
Route::post('/grades', [GradesController::class, 'store']);

Route::get('/reports', [ReportController::class, 'index']);
Route::post('/reports', [ReportController::class, 'generate']);