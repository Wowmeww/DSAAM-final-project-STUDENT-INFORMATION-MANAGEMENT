<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Hero');
});
// Route::get('/dashboard', function (Request $request) {
//     if($request->user_type == 'admin') {
//         return to_route('admin.dashboard');
//     } else if($request->user_type == 'teacher') {
//         return to_route('teacher.dashboard');
//     }
//     return to_route('student.dashboard');
// })->middleware('auth')->name('dashboard');

// ADMIN
Route::middleware(['auth', 'can:admin,' . User::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/students', [AdminController::class, 'students'])->name('admin.students');
    Route::get('/admin/add-student', [AdminController::class, 'addStudent'])->name('admin.add-student');
    Route::get('/admin/teachers', [AdminController::class, 'teachers'])->name('admin.teachers');
    Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::get('/admin/subjects', [AdminController::class, 'subjects'])->name('admin.subjects');

});
// Student
Route::middleware(['auth', 'can:student,' . User::class])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/grades', [StudentController::class, 'grades'])->name('student.grades');
});
// Teacher
Route::middleware(['auth', 'can:teacher,' . User::class])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/enroll-students', [TeacherController::class, 'enrollStudents'])->name('teacher.enroll-students');
    Route::get('/teacher/handled-classes', [TeacherController::class, 'handledClasses'])->name('teacher.handled-classes');
    Route::get('/teacher/submit-grades', [TeacherController::class, 'submitGrades'])->name('teacher.submit-grades');
});

require __DIR__ . '/auth.php';
