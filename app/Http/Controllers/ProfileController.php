<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $accountOwner = $user->owner;
        return Inertia::render('Profile', [
            'user' => $user,
            'account_owner' => $accountOwner
        ]);
    }


    public function update(Request $request, User $user)
    {
        $fields = null;
        switch ($user->access_type) {
            case 'admin':

                break;
            default:
                $fields = $request->validate([
                    'last_name' => ['required', 'max:254', 'string'],
                    'first_name' => ['required', 'max:254', 'string'],
                    'middle_name' => ['nullable', 'max:254'],
                    'sex' => ['required'],
                    'birth_date' => ['required', 'date'],
                ]);
        }

        $user->owner()->update($fields);
        return back()->with('message', 'Profile Updated');
    }


}
