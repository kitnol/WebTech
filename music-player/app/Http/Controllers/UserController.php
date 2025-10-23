<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    public function createuser(Request $request)
    {
        $user = User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')), 
        ]);
        
        auth()->login($user); //Log the user in

        return redirect()->route('pages.index');
    }
    //trial copied
    public function handleLogin(Request $request)
    {
        // 1. Define credentials using the 'username' key (CRITICAL FIX)
        $credentials = $request->validate([
            'username' => ['required'], // Validate the username field
            'password' => ['required'],
        ]);

        // 2. Attempt to log in using the 'username' and 'password'
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Login successful! Redirect them (e.g., to the profile page)
            return redirect()->intended('/pages/profile'); 
        }

        // 3. Login failed!
        return back()->withErrors([
            'username' => 'Invalid username or password. Please try again.',
        ])->onlyInput('username');
    }
}