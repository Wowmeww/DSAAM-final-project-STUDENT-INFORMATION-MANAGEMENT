<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Teacher/Dashboard');
    }
    public function index()
    {
        $teachers = Teacher::with('user')->latest()->simplePaginate(20);
        return Inertia::render('Admin/Teachers', [
            'teachers' => $teachers
        ]);
    }
    public function create()
    {

    }
    public function store()
    {

    }
    public function enrollStudents()
    {
        return Inertia::render('Teacher/EnrollStudents');
    }
    public function handledClasses()
    {
        return Inertia::render('Teacher/HandledClasses');
    }
    public function submitGrades()
    {
        return Inertia::render('Teacher/submitGrades');
    }
}
