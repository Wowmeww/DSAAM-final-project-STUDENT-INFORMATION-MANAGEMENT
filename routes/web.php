<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Models\User;

use Illuminate\Support\Facades\Route;

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.patch');

// ADMIN
Route::middleware(['auth', 'can:admin,' . User::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcement.create');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcement.store');
    Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcement.edit');
    Route::patch('/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcement.update');
    Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');

    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/students', [StudentController::class, 'store'])->name('student.store');

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::patch('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');

    Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('course.store');

    Route::get('/subjects', [SubjectController::class, 'index'])->name('subject.index');
    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subject.store');

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
