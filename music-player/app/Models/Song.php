<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Song extends Model
{

    protected $fillable = [
        'artist',
        'album',
        'title',
        'year',
        'description',
        'file_path_track',
        'file_path_music_sheet',
        'duration',
        'user_id',

    ];

    public function user() //know who the songs belong to
    {
    return $this->belongsTo(User::class);
    }

}