<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\SongController;
use App\Models\Song;

Route::get('/create', [AuthManager::class, 'create'])->name('create'); 
Route::post('/create', [AuthManager::class, 'createPost'])->name('create.post'); 

Route::get('/login', [AuthManager::class, 'login'])->name('login'); 
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post'); 

Route::get('/logout', [AuthManager::class, 'logout'])-> name('logout');

Route::get('/aboutus', function () {
    return view('aboutus'); 
})->name('aboutus'); 

Route::get('/', [AuthManager::class, 'demo'])->name('demo'); 

Route::group(['middleware' => 'auth'], function(){ //check if user is logged in or not
    Route::get('/artists', function () {
        return view('artists'); 
    })->name('artists'); 

    Route::get('/home', function () {
        return view('home'); 
    })->name('home'); 

    Route::get('/newtrack', [SongController::class, 'create'])->name('newtrack'); 
    Route::post('/newtrack', [SongController::class, 'store'])->name('newtrack.post'); 

    Route::get('/profile', function () {
        return view('profile'); 
    })->name('profile'); 

    Route::get('/tracks', function () {
        return view('tracks'); 
    })->name('tracks'); 

    Route::get('/songinfo/{song}', function (Song $song) {
        return view('songinfo', compact('song'));
    })->name('songinfo'); 

    Route::get('/artistinfo/{artist}', function ($artist) {
        $songs = auth()->user()->songs()->where('artist', $artist)->get();
        return view('artistinfo', [
        'artist' => $artist,
        'songs' => $songs,
        ]);
    })->name('artistinfo'); 
});