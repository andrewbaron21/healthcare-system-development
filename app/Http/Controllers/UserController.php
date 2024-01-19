<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUsersByRolePatient()
    {
        $usersWithPatientRole = User::role('patient')->get();
    
        return response()->json(['usersWithPatientRole' => $usersWithPatientRole]);
    }

    public function showProfileForm()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'surnames' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'email' => $request->email,
            'secure_password' => $request->has('password') ? true : false,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
