<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $q = filter_var($request->q, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $courses = null;

        if ($q) {
            $courses = Course::latest()->where('name', 'like', "%{$q}%")->get();
        } else {
            $courses = Course::latest()->get();
        }

        return Inertia::render('Admin/Courses', [
            'courses' => $courses,
            'query' => $q
        ]);
    }
    public function create()
    {
        return Inertia::render('Admin/AddCourse');
    }
    public function store(Request $request)
    {
        $course = $request->validate([
            'name' => ['required', 'unique:courses,name', 'max:254']
        ]);
        $course['name'] = strtoupper($course['name']);

        Course::create($course);

        return to_route('course.index')->with('message', 'New Course added');
    }
}
