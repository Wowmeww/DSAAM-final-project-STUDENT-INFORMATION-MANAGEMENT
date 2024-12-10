<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use FilterIterator;
use GuzzleHttp\Promise\Each;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $q = filter_var($request->q, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $teachers = Teacher::with('user');

        if ($q) {
            $teachers->whereAny(['last_name', 'first_name'], 'like', "%{$q}%");
        }

        $teachers = $teachers->latest('updated_at')->simplePaginate(20);

        foreach ($teachers as $i => $teacher) {
            // dump( $teacher->subjects);
            $teacher->subjects = Teacher::find($teacher->id)->subjects;
        }

        // $teachers = Teacher::with('user')->latest()->simplePaginate(20);
        return Inertia::render('Admin/Teachers', [
            'teachers' => $teachers,
            'query' => $q
        ]);
    }
    public function create()
    {
        $subjects = Subject::all();
        return Inertia::render('Admin/AddTeacher', [
            'subjects' => $subjects
        ]);
    }
    public function store(Request $request)
    {
        $teacherCredentials = $request->validate([
            "first_name" => ['required', 'max:254', 'string'],
            "last_name" => ['required', 'max:254', 'string'],
            "middle_name" => ['required', 'max:254', 'string'],
            "sex" => ['required', 'max:254', 'string'],
            "birth_date" => ['required', 'max:254', 'date'],
        ]);
        $userCredentials = $request->validate([
            "email" => ['required', 'unique:users,email', 'lowercase', 'email', 'max:254'],
            "password" => ['required', 'max:254']
        ]);
        $userCredentials['access_type'] = 'teacher';

        $subjects = $request->validate([
            'subjects' => ['nullable', 'array']
        ]);
        $subjects = $subjects['subjects'];

        $user = User::create($userCredentials);
        $teacher = $user->owner()->create($teacherCredentials);

        foreach ($subjects as $key => $v) {
            $teacher->addSubject($v);
        }

        return to_route('teacher.index')->with('message', 'New Teacher Registered.');
    }
    public function edit(Teacher $teacher)
    {
        return Inertia::render('Admin/EditTeacherSubjects', [
            'teacher' => $teacher,
            'teacherSubjects' => $teacher->subjects,
            'teacherName' => $teacher->name,
            'subjects' => Subject::all()
        ]);
    }
    public function update(Teacher $teacher, Request $request)
    {
        $subjects = $request->validate([
            'subjects' => ['nullable', 'array']
        ]);
        $teacher->removeAllSubjects();
        foreach ($subjects['subjects'] as $id) {
            $teacher->addSubject($id);
        }

        return to_route('teacher.index')->with('message', "Teacher {$teacher->name} handled subjects updated!");
    }
}
