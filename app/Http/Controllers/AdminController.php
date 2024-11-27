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
}
