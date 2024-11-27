<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function dashboard() {
        return Inertia::render('Teacher/Dashboard');
    }
    public function enrollStudents() {
        return Inertia::render('Teacher/EnrollStudents');
    }
    public function handledClasses() {
        return Inertia::render('Teacher/HandledClasses');
    }
    public function submitGrades() {
        return Inertia::render('Teacher/submitGrades');
    }
}
