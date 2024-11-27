<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        // dd(request()->user());
        return Inertia::render('Admin/Dashboard');
    }
    public function students(Request $request)
    {
        $q = htmlspecialchars($request->q);
        $students = Student::with('user');

        if ($q) {
            $students = Student::with('user')->where('first_name', 'like', "%{$request->q}%")
                ->orWhere('last_name', 'like', "%{$q}%")
                ->orWhere('first_name', 'like', "%{$q}%")
                ->orWhere('year', 'like', "%{$q}%")
                ->orWhere('course', 'like', "%{$q}%");
        }

        return Inertia::render('Admin/Students', [
            'students' => $students->latest()->simplePaginate(20)->withQueryString(),
            'query' => $q
        ]);
    }
    public function addStudent()
    {
        $courses = Course::all();
        return Inertia::render('Admin/AddStudent', [
            'courses' => $courses
        ]);
    }
    public function teachers()
    {
        return Inertia::render('Admin/Teachers');
    }
    public function courses()
    {
        return Inertia::render('Admin/Courses');
    }
    public function subjects()
    {
        return Inertia::render('Admin/Subjects');
    }
}
