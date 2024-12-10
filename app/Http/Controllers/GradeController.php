<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Subject;
use App\Models\TeacherEnrolledClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class GradeController extends Controller
{
    public function edit(Request $request)
    {
        $class_id = filter_var($request->class, FILTER_SANITIZE_NUMBER_INT);
        $subject_id = filter_var($request->subject, FILTER_SANITIZE_NUMBER_INT);

        $teacher = Auth::user()->owner;
        $classes = $teacher->enrolledClasses;
        $student_class = $classes->first(
            fn($sc) => $sc->class_id == $class_id
            &&
            $sc->subject_id == $subject_id
        );

        $class_students = $student_class ? $student_class->class->students->each(fn($s) => $s->grades) : null;

        // dd($class_students->first()->grades);

        return Inertia::render('Teacher/SubmitGrades', [
            'teacher' => $teacher,
            'classes' => $classes,
            'students' => $class_students,
            'subject' => Subject::find($subject_id)
        ]);
    }

    public function patch(Request $request)
    {
        $students = $request->students;
        $students = array_filter($students, fn($s) => $s['grade']);
        foreach ($students as $student) {
            throw_if($student['grade'] > 100, ValidationException::withMessages(['grades' => 'Student grade is more than 100.']));
        }

        if (is_array($students)) {
            foreach ($students as $student) {
                $grade = Grade::firstOrCreate([
                    'student_id' => $student['student_id'],
                    'subject_id' => $student['subject_id'],
                    'teacher_id' => $student['teacher_id'],
                ]);
                $grade->update([
                    'grade' => $student['grade']
                ]);
            }
        }
        return back()->with('message', 'Grades updated');
    }
    public function index(Request $request)
    {
        $student = $request->user()->owner;
        $grades = $student->grades;
        return Inertia::render('Student/Grades', [
            'student' => $student,
            'grades' => $grades,
        ]);
    }


}
