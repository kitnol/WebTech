<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect(route('home')); //if user is logged in, the login page cannot be accessed
        }
        return view('login'); 
    }

    public function create(){
        if(Auth::check()){
            return redirect(route('home')); //if user is logged in, the create new user page cannot be accessed
        }
        return view('create');
    }

    public function demo(){
        if(Auth::check()){
            return redirect(route('home')); //if user is logged in, the demo page cannot be accessed
        }
        return view('demo');
    }

    public function loginPost(Request $request){
        $request -> validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email','password');
        
        if (Auth::attempt($credentials)){
            return redirect()->intended(route('home')); 
        }

        return redirect(route('login'))->with("error", "Invalid details, please try again");
    }

    public function createPost(Request $request){
        $request -> validate([
            'username' => ['required'],
            'email' => 'required|email|unique:users',
            'password' => ['required'],
        ]);

        $data['username']= $request-> username;
        $data['email']= $request-> email;
        $data['password']= Hash::make($request-> password); //make the password encripted
        $user=User::create($data); //pass the data
        if (!$user){
            return redirect(route('create'))->with("error", "No user, registration failed");
        }
        return redirect(route('login'))->with("success", "Registration successful, Please log in");
    }

    
    public function editemailPost(Request $request){
        $request -> validate([
            'email' => 'required|email|unique:users',
        ]);
        if (!$request){
            return redirect(route('editemail'))->with("error", "Email already in use");
        }
        $data['email']= $request-> email;
        $user=User::changeEmail($data); //pass the data
        if (!$user){
            return redirect(route('editemail'))->with("error", "Email change failed");
        }
        return redirect(route('profile'))->with("success", "Email changed successfully");
    }
    public function editprofilePost(Request $request){
        $request -> validate([
            'username' => 'required|string|max:255',
        ]);
        if (!$request){
            return redirect(route('profile'))->with("error", "Profile update failed");
        }
        $data['username']= $request-> username;
        $user=User::changeProfile($data); //pass the data
        if (!$user){
            return redirect(route('profile'))->with("error", "Profile update failed");
        }
        return redirect(route('profile'))->with("success", "Profile updated successfully");
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
