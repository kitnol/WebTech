<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Artist;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\SongController;

class FavoriteController extends Controller
{
    public function toggleFavorite(Song $song)
    {
        $user = auth()->user();
        if (!$user->isPremium()) {
            return redirect()->back()->with('error', 'This feature is for premium users only.');
        }
        $user->favorites()->toggle($song->id);
        return redirect()->back();
    }
        
    public function index(){
        $favorites = auth()->user()->favorites()->get();
        return view('favorites', compact('favorites'));
    }
}
