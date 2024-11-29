<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AddAnnouncement');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $announcement = $request->validate([
            'title' => ['required', 'max:254', 'string'],
            'content' => ['required', 'string'],
        ]);

        Auth::user()->owner->announcements()->create($announcement);

        return to_route('admin.dashboard')->with('message', 'Announcement with the title of ' . $announcement['title'] . ' was created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return Inertia::render('Admin/EditAnnouncement', [
            'announcement' => $announcement
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $updatedAnnouncement = $request->validate([
            'title' => ['required', 'max:254', 'string'],
            'content' => ['required', 'string']
        ]);
        $announcement->update($updatedAnnouncement);

        return to_route('admin.dashboard')->with('message', 'Announcement wit the title of "'. $announcement->title . '" updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $title = $announcement->title;
        $announcement->delete();

        return to_route('admin.dashboard')->with('message', 'Announcement with the title of "' . $title . '" was deleted.');
    }
}
