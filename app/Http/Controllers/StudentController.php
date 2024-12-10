<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;

use function Laravel\Prompts\select;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $q = htmlspecialchars($request->q);
        $students = Student::with('user')->latest();
        if ($q) {
            $student_class = StudentClass::with('students')->whereLike('name', "%{$q}%")->get();
            $students = Student::with('user')
                ->whereAny([
                    'last_name',
                    'first_name',
                    'middle_name'
                ], 'like', "%{$q}%");
            foreach ($student_class as $value) {
                $students = $students->orWhereLike('class_id', $value->id);
            }
        }
        $students = $students->simplePaginate(20)->withQueryString();
        return Inertia::render('Admin/Students', [
            'students' => $students,
            'courses' => Course::all(),
            'query' => $q
        ]);
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
        $studentCredentials = $request->validate([
            "first_name" => ['required', 'max:244',],
            "last_name" => ['required', 'max:244',],
            "middle_name" => ['required', 'max:244',],
            "sex" => ['required', 'max:244',],
            "birth_date" => ['required', 'date', 'max:244',],
            "course_id" => ['required', 'max:244',],
            "year" => ['required', 'max:244', 'numeric', 'min:1'],
            "block" => ['required', 'max:244',],
        ]);
        $course_name = Course::find($request->course_id)->name;
        $class_name = "{$course_name} {$request->year}-{$request->block}";
        $class_model = StudentClass::addClass($class_name);

        $studentCredentials['class_id'] = $class_model->id;

        $userCredentials = $request->validate([
            "email" => ['required', 'unique:users,email', 'max:244', 'email', 'lowercase'],
            "password" => ['required', 'max:244',]
        ]);
        $userCredentials['access_type'] = 'student';

        $user = User::create($userCredentials);
        $user->owner()->create($studentCredentials);

        return to_route('student.index')->with('message', 'New Student Registered');
    }
}
