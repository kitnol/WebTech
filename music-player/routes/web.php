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

Route::resource('songs', SongController::class);

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

    Route::get('/passedit', function () {
        return view('passedit');
    })->name('passedit');

    Route::get('/tracks', function () {
        return view('tracks');
    })->name('tracks');

    Route::post('/editemail', [AuthManager::class, 'editemailPost'])->name('editemail.post');

    Route::post('/editprofile', [AuthManager::class, 'editprofilePost'])->name('editprofile.post');

    Route::post('/editsong', [SongController::class, 'editsongPost'])->name('editsong.post');

    Route::post('/changepassword', [AuthManager::class, 'changepasswordPost'])->name('changepassword.post');

    Route::get('/songinfo/{song}', function (Song $song) {
        return view('songinfo', compact('song'));
    })->name('songinfo');
    Route::get('/home/{play}', function (Song $song) {
        return view('home', compact('play'));
    })->name('home.play');

    Route::get('/artistinfo/{artist_id}', function ($artist_id) {
        $songs = auth()->user()->songs()->where('artist_id', $artist_id)->get();
        return view('artistinfo', [
        'artist' => auth()->user()->artists()->where('id', $artist_id)->first(),
        'songs' => $songs,
        ]);
    })->name('artistinfo');

    Route::get('/editartist/{artist}', function ($artist) {
        $songs = auth()->user()->songs()->where('artist', $artist)->get();
        return view('editartist', [
        'artist' => $artist,
        'songs' => $songs,
        'cover_art' => $cover_art,
        ]);
    })->name('editartist');

    Route::post('/editartist', [SongController::class, 'editartistPost'])->name('editartist.post');
});
