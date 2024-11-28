<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public function index(Request $request) {
        $q = filter_var($request->q, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $subjects = null;

        if ($q) {
            $subjects = Subject::latest()->where('name', 'like', "%{$q}%")->get();
        } else {
            $subjects = Subject::latest()->get();
        }

        return Inertia::render('Admin/Subjects', [
            'subjects' => $subjects,
            'query' => $q
        ]);
    }
    public function create() {
        return Inertia::render('Admin/AddSubject');
    }
    public function store(Request $request) {
        $subject = $request->validate([
            'name' => ['required', 'unique:subjects,name']
        ]);
        Subject::create($subject);

        return to_route('subject.index')->with('message', 'New Subject Added');
    }
}
