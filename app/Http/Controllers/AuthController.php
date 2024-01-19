<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
      /**
     * Register a new user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'surnames' => 'required|string',
            'identification_card' => 'required|integer',
            'email' => 'required|email|unique:users',
            'secure_password' => 'required|boolean',
        ]);
        
        $password = $request->password ?? $request->identification_card;

        $user = User::create([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'identification_card' => $request->identification_card,
            'email' => $request->email,
            'password' => Hash::make($password),
            'secure_password' => $request->secure_password,
        ]);

        if ($request->role == 'professional') {
            $user->assignRole('professional');
        } else {
            $user->assignRole('patient');
        }

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }

    /**
     * Log in a user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['message' => 'Login successful', 'token' => $token]);
        }

        throw ValidationException::withMessages(['error' => 'Invalid credentials']);
    }

    /**
     * Log out the authenticated user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful']);
    }
}
