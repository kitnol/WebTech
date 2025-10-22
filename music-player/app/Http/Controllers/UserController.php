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

        return redirect()->route('pages.login')
        ->with('success', 'User account created successfully! Please log in.');
    }
}