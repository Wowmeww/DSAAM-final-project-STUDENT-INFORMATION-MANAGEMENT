<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherEnrolledClassController;
use App\Models\User;

use Illuminate\Support\Facades\Route;


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
    Route::get('/student/grades', [GradeController::class, 'index'])->name('student.grades');
});
// Teacher
Route::middleware(['auth', 'can:teacher,' . User::class])->group(function () {
    Route::get('/handled-classes', [TeacherEnrolledClassController::class, 'edit'])->name('teacher-enrolled-class.edit');
    Route::get('/enroll-students', [TeacherEnrolledClassController::class, 'create'])->name('teacher-enrolled-class.create');
    Route::post('/enroll/{studentClass}/{subject}', [TeacherEnrolledClassController::class, 'store'])->name('teacher-enrolled-class.store');
    Route::delete('/un-enroll/{teacherEnrolledClass}', [TeacherEnrolledClassController::class, 'destroy'])->name('teacher-enrolled-class.destroy');
    Route::get('/submit-grades', [GradeController::class, 'edit'])->name('grade.edit');
    Route::patch('/submit-grades', [GradeController::class, 'patch'])->name('grade.patch');
});

require __DIR__ . '/auth.php';
