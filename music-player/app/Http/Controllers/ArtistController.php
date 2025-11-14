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
}
