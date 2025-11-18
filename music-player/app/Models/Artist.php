<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Artist extends Model{

    protected $fillable = [
        'artist',
        'cover_art_path',
        'description',
        'user_id',
    ];

    public function user() //know who the songs belong to
    {
        return $this->belongsTo(User::class);
    }
    
}
