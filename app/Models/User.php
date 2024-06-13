<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\RegistrationSuccessNotification;
use App\Notifications\UserFollowNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ph_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notes(){
        return $this->hasMany(Note::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function markdowns(){
        return $this->hasMany(Markdown::class);
    }

    protected static function boot()
    {
        parent::boot();

        //for notifying the user about the markdown
        static::created(function ($user) {
            if ($user) {
                $user->notify(new RegistrationSuccessNotification($user));
            }
        });
    }
}
