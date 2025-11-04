<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Song;
use Illuminate\Support\Facades\Session;

class SongController extends Controller
{
    public function create(){
        return view('newtrack');
    }

    public function store(Request $request){
        $request -> validate([
            'artist'=> 'required|string|max:255',
            'album' =>'nullable|string|max:255',
            'title'=> 'required|string|max:255',
            'year'=>'nullable|integer|min:0|max:2100',
            'description'=>'nullable|string',
            'file_path_track.*'=>'nullable|mimes:mp3,wav,acc|max:5120', //5MB
            'file_path_music_sheet'=>'nullable|mimes:doc,docx,pdf,png,jpg,jpeg|max:5120'//5MB
        ]);

        //copied DOES NOT WORK
        $trackPaths = null;
        if ($request->hasFile('file_path_track')) {
            $trackPaths = [];
            foreach ($request->file('file_path_track') as $track) {
                $trackPaths[] = $track->store('tracks', 'public');
            }
        }


        $musicSheetPath = null; //no file uploaded
        if ($request->hasFile('file_path_music_sheet')) { //file uploaded
            $musicSheetPath = $request->file('file_path_music_sheet')->store('music_sheets', 'public'); //store file in public disk in folder music_sheets
        }
        //endcopied UNTIL HERE

        $songinfo['artist']= $request-> artist;
        $songinfo['album']= $request-> album;
        $songinfo['title']= $request-> title;
        $songinfo['year']= $request-> year;
        $songinfo['description']= $request-> description;
        $songinfo['file_path_track'] = $trackPaths ? implode(',', $trackPaths) : null; //copied
        $songinfo['file_path_music_sheet'] = $musicSheetPath;

        $song=auth()->user()->songs()->create($songinfo); //pass the data while linking it to a user

        return redirect(route('tracks'))->with("success", "The song has been recoded successfully!");

    }

    public function editartistPost(Request $request){
        
        $currentArtist = $request->input('current_artist');
        $newArtist = $request->input('new_artist');

        // 1. Validate the inputs
        $request->validate([
            'current_artist' => 'required|string|max:255', 
            'new_artist' => [
                'required', 
                'string', 
                'max:255',
            ], 
        ]);

        // Changing artist name everywhere
        $updatedCount = auth()->user()->songs()
            ->where('artist', $currentArtist)
            ->update(['artist' => $newArtist]);

        if ($updatedCount > 0){
            return redirect(route('artistinfo', ['artist' => $newArtist]))
                   ->with("success", "Artist '{$currentArtist}' successfully renamed to '{$newArtist}' across {$updatedCount} songs.");
        }
    }
}
