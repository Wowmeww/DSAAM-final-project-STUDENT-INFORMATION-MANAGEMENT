<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
            'remember' => ['boolean', 'nullable']
        ]);

        if (Auth::attempt(Arr::except($credentials, 'remember'), $request->remember)) {
            $request->session()->regenerate();
            $user = $request->user();

            if ($user->access_type == 'admin') {
                return to_route('admin.dashboard')->with('message', 'Welcome back Admin');
            } elseif ($user->access_type == 'teacher') {
                return to_route('teacher.dashboard')
                    ->with('message',
                    "Welcome back {$user->owner->first_name} {$user->owner->middle_name[0]}. {$user->owner->last_name}"
                );
            }

            return to_route('student.dashboard')->with('message', "Welcome back {$user->owner->first_name} {$user->owner->middle_name[0]}.  {$user->owner->last_name}");
        }

        throw_if(User::where('email', 'is', $credentials['email'])->first(), ValidationException::withMessages(['password' => 'Wrong password!']));
        throw ValidationException::withMessages(['email' => 'Credentials has no match in our records.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }
}
