<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Song;
use App\Models\Artist;
use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Session;

class SongController extends Controller
{
    public function create(){
        return view('newtrack');
    }

    public function store(Request $request){
        $validatedData = $request -> validate([
            'artist'=> 'nullable|string|max:255',
            'album' =>'nullable|string|max:255',
            'title'=> 'required|string|max:255',
            'year'=>'nullable|integer|min:0|max:2100',
            'description'=>'nullable|string',
            'file_path_track'=>'required|mimes:mp3,wav,acc|max:11120', //5MB
            'cover_art_path'=>'nul
            lable|mimes:png,jpg,jpeg|max:5120',//5MB
        ]);

        $picturePath = null;
        if ($request->hasFile('cover_art_path')) {
            $picturePath = $request->file('cover_art_path')->store('song_covers', 'public');
        }

        $trackPath = null;
        if ($request->hasFile('file_path_track')) {
            $trackPath = $request->file('file_path_track')->store('song_tracks', 'public');
        }

        $artist = Artist::where('artist', $request->input('artist'))->first();
        if($artist == null){
            $artist_id = ArtistController::store(['artist' => $request->artist, 'cover_art_path' => null, 'description' => null]);
        }
        else{
           $artist_id = $artist->id;
        }

        $songinfo['artist_id']= $artist_id;
        $songinfo['album']= $request-> album;
        $songinfo['title']= $request-> title;
        $songinfo['year']= $request-> year;
        $songinfo['description']= $request-> description;
        $songinfo['file_path_track'] = $trackPath;
        $songinfo['cover_art_path'] = $picturePath;

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

    public function download($id)
    {
        $song = Song::findOrFail($id);

        //Check if user owns the song or has permission
        if ($song->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get the full path to the file
        $filePath = storage_path('app/public/' . $song->file_path_track);

        // Check if file exists
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }
        $artist = Artist::findOrFail($song->artist_id)->artist;

        // Generate a friendly filename
        $fileName = $artist . ' - ' . $song->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

        // Return the file as a download
        return response()->download($filePath, $fileName);
    }

    public function editsongPost(Request $request){
        $request -> validate([
            'album' =>'nullable|string|max:255',
            'title'=> 'required|string|max:255',
            'year'=>'nullable|integer|min:0|max:2100',
            'description'=>'nullable|string'
        ]);

        $song = Song::findOrFail($request->input('song_id'));
        $songinfo['album']= $request-> album;
        $songinfo['title']= $request-> title;
        $songinfo['year']= $request-> year;
        $songinfo['description']= $request-> description;
        $song->update($songinfo);   //push the change to DB
        return redirect(route('songinfo', ['song' => $song->id]))->with("success", "The song has been recoded successfully!");
    }

    public function destroy(Request $request)
    {
        $song = Song::findOrFail($request->id);

        if ($song->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }

        if ($song->file_path_track) {
            $song_path = explode(',', $song->cover_art_path);
            \Storage::disk('public')->delete($song_path);
        }

        if ($song->cover_art_path) {
            $cover_art = explode(',', $song->cover_art_path);
            \Storage::disk('public')->delete($cover_art);
        }

        $song->delete();

        return response()->json(['success' => true, 'message' => 'Artist deleted successfully.']);
    }

    public static function destroy_with_artist($id)
    {
        $songs = Song::where('artist_id', $id)->get();

        foreach ($songs as $song) {
            if ($song->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            if ($song->file_path_track) {
                $tracks = explode(',', $song->file_path_track);
                foreach ($tracks as $track) {
                    \Storage::disk('public')->delete($track);
                }
            }

            if ($song->cover_art_path) {
                \Storage::disk('public')->delete($song->cover_art_path);
            }

            $song->delete();
        }
    }
}