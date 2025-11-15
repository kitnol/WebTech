<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Artist;
use Illuminate\Support\Facades\Session;

class ArtistController extends Controller
{
    public function create(){
        return view('newtrack');
    }

    public static function store($artist){

        $picturePath = null;

        $artistinfo['artist']= $artist['artist'];
        $artistinfo['cover_art_path'] = $picturePath;
        $artistinfo['description']= $artist['description']  ;
        $artist=auth()->user()->artists()->create($artistinfo); //pass the data while linking it to a user

        return $artist->id;

    }

    public function editartistPost(Request $request){

        $idArtist = $request->input('artist_id');
        $newArtist = $request->input('new_artist');

        // 1. Validate the inputs
        $request->validate([
            'artist_id' => 'required|integer',
            'new_artist' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        // Changing artist name everywhere
        $updatedCount = auth()->user()->artists()
            ->where('id', $idArtist)
            ->update(['artist' => $newArtist]);

        if ($updatedCount > 0){
            return redirect(route('artistinfo', ['artist_id' => $idArtist]))
                ->with("success", "Artist '{$idArtist}' successfully renamed to '{$newArtist}' across {$updatedCount} songs.");
        }
    }
}
