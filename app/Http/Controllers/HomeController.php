<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // Get the authenticated user
        $user = Auth::user();
        // Check if the user has secure_password set to false
        if ($user->secure_password == false) {
            // Display a notification or perform some action
            return redirect()->route('clinicalhistories.index')->with('warning', 'Please change your password.');
        }

        return redirect()->route('clinicalhistories.index');
    }
}
