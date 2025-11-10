<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Artist extends Model{

    protected $fillable = [
        'artist',
        'artist_id',
        'cover_art',
        'album',
        'title',
        'year',
        'description',
        'file_path_track',
        'file_path_music_sheet',
        'file_path_image',
        'duration',
        'user_id',
    ];

    public function user() //know who the songs belong to
    {
        return $this->belongsTo(User::class);
    }

}
