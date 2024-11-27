<?php

use App\Http\Controllers\AdminController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\User;

use Illuminate\Support\Facades\Route;


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

    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');

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
