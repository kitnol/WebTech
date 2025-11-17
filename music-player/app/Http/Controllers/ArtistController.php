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

class ArtistController extends Controller
{
    public function create()
    {
        return view('newtrack');
    }

    public static function store($artist)
    {

        $picturePath = null;

        $artistinfo['artist'] = $artist['artist'];
        $artistinfo['cover_art_path'] = $picturePath;
        $artistinfo['description'] = $artist['description'];
        $artist = auth()->user()->artists()->create($artistinfo); //pass the data while linking it to a user

        return $artist->id;

    }

    public function editartistPost(Request $request)
    {

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

        if ($updatedCount > 0) {
            return redirect(route('artistinfo', ['artist_id' => $idArtist]))
                ->with("success", "Artist '{$idArtist}' successfully renamed to '{$newArtist}' across {$updatedCount} songs.");
        }
    }

    public function editartistPhoto(Request $request)
    {
        // 1. Validate the inputs first
        // Debug: Check what's being received
        //sdd($request->all(), $request->hasFile('cover_art_path'));

        $request->validate([
            'artist_id' => 'required|integer',
            'cover_art_path' => 'required|file|mimes:png,jpg,jpeg|max:5120',
        ]);

        $idArtist = $request->input('artist_id');

        // 2. Find the artist and check ownership
        $artist = auth()->user()->artists()->find($idArtist);

        if (!$artist) {
            return redirect()->back()
                ->with("error", "Artist not found or you don't have permission.");
        }

        // 3. Delete old photo if it exists
        if ($artist->cover_art_path !== null) {
            \Storage::disk('public')->delete($artist->cover_art_path);
        }

        // 4. Upload new photo
        if ($request->hasFile('cover_art_path')) {
            $picturePath = $request->file('cover_art_path')->store('artist_photo', 'public');

            $artist->update(['cover_art_path' => $picturePath]);

            return redirect(route('artistinfo', ['artist_id' => $idArtist]))
                ->with("success", "Artist photo was successfully updated.");
        }

        return redirect()->back()
            ->with("error", "No photo file was uploaded.");
    }

    public function destroy(Request $request)
    {
        $artist = Artist::findOrFail($request->id);

        if ($artist->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }

        if ($artist->cover_art_path) {
            $cover_art = explode(',', $artist->cover_art_path);
            \Storage::disk('public')->delete($cover_art);
        }

        SongController::destroy_with_artist($request->id);

        $artist->delete();

        return response()->json(['success' => true, 'message' => 'Artist deleted successfully.']);
    }
}
