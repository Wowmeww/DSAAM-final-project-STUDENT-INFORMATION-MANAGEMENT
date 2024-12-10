<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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
        $credentials = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
            'remember' => ['boolean', 'nullable']
        ]);

        if (Auth::attempt(Arr::except($credentials, 'remember'), $request->remember)) {
            $request->session()->regenerate();
            $user = $request->user();

            return to_route('user.dashboard')->with('message', "Welcome back {$user->owner->full_name}.");
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
