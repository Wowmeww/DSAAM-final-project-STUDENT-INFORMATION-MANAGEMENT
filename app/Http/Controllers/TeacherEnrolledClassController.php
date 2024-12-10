<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use App\Models\Subject;
use App\Models\TeacherEnrolledClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function Laravel\Prompts\select;

class TeacherEnrolledClassController extends Controller
{
    public function create(Request $request)
    {
        $q = filter_var($request->q, FILTER_SANITIZE_SPECIAL_CHARS);

        $student_classes = StudentClass::when(
            !$q,
            fn($c) => $c->with('students'),
            fn($c) => $c->with('students')->whereLike('name', "%{$q}%")
        )->simplePaginate()->withQueryString();

        $teacher = Auth::user()->owner;
        $teacher_subjects = $teacher->subjects;

        return Inertia::render('Teacher/EnrollStudents', [
            'student_classes' => $student_classes,
            'teacher' => $teacher,
            'teacher_subjects' => $teacher_subjects,
            'query' => $q
        ]);
    }
    public function store(Request $request, StudentClass $studentClass, Subject $subject)
    {
        $teacher = $request->user()->owner;
        $teacher->enrolledClasses()->firstOrCreate([
            'subject_id' => $subject->id,
            'class_id' => $studentClass->id
        ]);

        return back()->with('message', "\"{$studentClass->name}\" enrolled in \"{$subject->name}\"");
    }
    public function edit(Request $request)
    {
        $q = filter_var($request->q, FILTER_SANITIZE_SPECIAL_CHARS);

        $teacher = Auth::user()->owner;
        $teacher_classes = null;

        if (!$q) {
            $teacher_classes = TeacherEnrolledClass::with('class')->where('teacher_id', '=', $teacher->id)->get();
        } else {
            $classes = StudentClass::with('students')->whereLike('name', "%{$q}%")->get('id');
            $class_ids = [];
            foreach ($classes as $value) {
                $class_ids[] = $value->id;
            }

            $subjects = Subject::whereLike('name', "%{$q}%")->get('id');
            $subject_ids = [];
            foreach ($subjects as $value) {
                $subject_ids[] = $value->id;
            }
            $teacher_classes = TeacherEnrolledClass::with('classes')
                ->whereIn('class_id', $class_ids)
                ->orWhereIn('subject_id', $subject_ids)->get();
        }

        return Inertia::render('Teacher/HandledClasses', [
            'teacher' => $teacher,
            'teacher_classes' => $teacher_classes,
        ]);
    }
    public function destroy(TeacherEnrolledClass $teacherEnrolledClass)
    {
        $teacherEnrolledClass->delete();

        $message = "\"{$teacherEnrolledClass->class_name}\" un-enrolled in subject named \"{$teacherEnrolledClass->subject_name}\"";

        return back()->with('message', $message);
    }
}
