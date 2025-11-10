<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Song;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table ="users"; //might be needed
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //get the songs from the user
    public function songs()
    {
        return $this->hasMany(Song::class);
    }


    public static function changeEmail($data)
    {
        // Assuming you have an authenticated user
        $user = auth()->user();
        if ($user->email === $data['email']) { // if new email is different from the current
            return false; // dont update
        }

        // Update the email address
        $user->email = $data['email'];
        return $user->save(); // Save the updated user
    }
    public static function changeProfile($data)
    {
        // Assuming you have an authenticated user
        $user = auth()->user();
        if ($user->username === $data['username']) { // if new username is different from the current
            return false; // dont update
        }

        // Update the username
        $user->username = $data['username'];
        return $user->save(); // Save the updated user
    }

    public static function changePassword($data)
    {
        $user = auth()->user();
        if (!$user || empty($data['password'])) {
            return false;
        }
        // pass plain password; the 'hashed' cast will hash it
        $user->password = $data['password'];
        return $user->save();
    }

}
