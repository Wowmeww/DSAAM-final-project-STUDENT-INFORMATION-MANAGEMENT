<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Student/Dashboard');
    }
    public function index(Request $request)
    {
        $q = htmlspecialchars($request->q);
        $students = Student::with('user')->latest();
        if ($q) {
            $courses = Course::whereLike('name', "%{$q}%")->first();
            $courses = $courses? $courses->id: null;

            $students = $students->whereAny([
                'last_name',
                'first_name',
                'middle_name'
            ], 'like', "%{$q}%")
            ->orWhereLike('course_id', $courses);
        }
        $students = $students->simplePaginate(20);
        return Inertia::render('Admin/Students', [
            'students' => $students->withQueryString(),
            'courses' => Course::all(),
            'query' => $q
        ]);
    }
    public function show()
    {

    }
    public function create()
    {
        $courses = Course::all();
        return Inertia::render('Admin/AddStudent', [
            'courses' => $courses
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $studentCredentials = $request->validate([
            "first_name" => ['required', 'max:244',],
            "last_name" => ['required', 'max:244',],
            "middle_name" => ['required', 'max:244',],
            "sex" => ['required', 'max:244',],
            "birth_date" => ['required', 'date', 'max:244',],
            "course" => ['required', 'max:244',],
            "year" => ['required', 'max:244', 'numeric', 'min:1'],
            "block" => ['required', 'max:244',],
        ]);
        $userCredentials = $request->validate([
            "email" => ['required', 'unique:users,email', 'max:244', 'email', 'lowercase'],
            "password" => ['required', 'max:244',]
        ]);
        $userCredentials['access_type'] = 'student';

        $user = User::create($userCredentials);
        $user->owner()->create($studentCredentials);

        return to_route('student.index')->with('message', 'New Student Registered');
    }

    public function grades()
    {
        return Inertia::render('Student/Grades');
    }
}
