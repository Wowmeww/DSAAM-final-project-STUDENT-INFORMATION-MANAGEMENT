<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    public function requestPasswordReset(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $existingToken = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if ($existingToken) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        }
        $token = Str::random(60);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now()
        ]);

        return response()->json([
            'message' => 'Token generated successfully',
            'token' => $token
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $passwordReset = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            return response()->json(['message' => 'Invalid token'], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Password reset successfully'], 200);
    }

    public function changePassword(Request $request)
    {
        $password = $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->old_password
            ])
        ) {
            User::find($request->user['id'])->update(['password' => $request->password]);

            return back()->with('message', 'Password Updated.');
        }

        throw ValidationException::withMessages(['old_password' => 'Wrong Password']);
    }
}
