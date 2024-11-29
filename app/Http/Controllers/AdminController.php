<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $q = $request->q;
        $announcements = Announcement::latest()->get();

        if ($q) {
            $announcements = Announcement::where('title', 'like', "%{$q}%")
                ->orWhere('content', 'like', "%{$q}%")->latest()->get();
        }

        return Inertia::render('Admin/Dashboard', [
            'announcements' => $announcements,
            'query' => $q
        ]);
    }
}
