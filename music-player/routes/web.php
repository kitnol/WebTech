<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // Import the controller

Route::get('/users/create', function () {
    return view('users.index'); 
})->name('users.create'); 

Route::get('/pages/aboutus', function () {
    return view('pages.aboutus'); 
})->name('pages.aboutus'); 

Route::get('/pages/artists', function () {
    return view('pages.artists'); 
})->name('pages.artists'); 

Route::get('/pages/create', function () {
    return view('pages.create'); 
})->name('pages.create'); 

Route::get('/pages/index', function () {
    return view('pages.index'); 
})->name('pages.index'); 

Route::get('/pages/login', function () {
    return view('pages.login'); 
})->name('pages.login'); 

Route::get('/pages/newtrack', function () {
    return view('pages.newtrack'); 
})->name('pages.newtrack'); 

Route::get('/pages/newtrack', function () {
    return view('pages.newtrack'); 
})->name('pages.newtrack');

Route::get('/pages/profile', function () {
    return view('pages.profile'); 
})->name('pages.profile'); 

Route::get('/pages/tracks', function () {
    return view('pages.tracks'); 
})->name('pages.tracks'); 

//POST
Route::post('/pages', [UserController::class, 'createuser'])
    ->name('pages.userstore'); 