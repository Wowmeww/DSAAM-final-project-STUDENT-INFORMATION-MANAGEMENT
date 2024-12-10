<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        $accountOwner = $user->owner;

        return Inertia::render('Profile', [
            'user' => $user,
            'account_owner' => $accountOwner
        ]);
    }


    public function update(Request $request)
    {
        $fields = $request->validate([
            "last_name" => ['required', 'max:254'],
            "first_name" => ['required', 'max:254'],
            "middle_name" => ['nullable', 'max:254'],
            "sex" => ['required', 'max:254'],
            "birth_date" => ['required', 'max:254', 'date'],
        ]);

        $request->user()->owner->update($fields);

        return back()->with('message', 'Profile Updated');
    }


}
