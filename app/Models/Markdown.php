<?php

namespace App\Models;

use App\Notifications\UserFollowNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Markdown extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function note()
    {
        return $this->belongsTo(Note::class, 'note_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    protected static function boot()
    {
        parent::boot();

        //for notifying the user about the markdown
        static::created(function ($markdown) {
            $note = $markdown->note;

            if ($note && $note->user && $note->user->id != Auth::id()) {
                $userId = $note->uuid;
                $userName = Auth::user()->name;
                $message = 'has markdowned on your note ' . $note->title;
                $note->user->notify(new UserFollowNotification($userId, $userName, $message));
            }
        });
    }
}
