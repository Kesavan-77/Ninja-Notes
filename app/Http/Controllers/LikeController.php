<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Note;
use App\Models\User;
use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function count(Request $request)
    {
        $note_id = $request->noteId;
        $like_count = Like::where('note_id', $note_id)->count();

        return response()->json($like_count);
    }

    public function manage(Request $request)
    {
        $note_id = $request->noteId;
        $user_id = Auth::id();

        $like = Like::where('note_id', $note_id)->where('user_id', $user_id)->first();

        if (!$like) {
            Like::create([
                "note_id" => $note_id,
                "user_id" => $user_id,
                "like" => "liked",
            ]);

            $note = Note::with('user')->find($note_id);

            if ($note && $note->user && $note->user->id != Auth::id()) {
                $userId = $note->user->id;
                $userName = Auth::user()->name;
                $message = 'has liked your note '.$note->title;
                $note->user->notify(new UserFollowNotification($userId, $userName, $message));
            }

        } else {
            Like::where('note_id', $note_id)->where('user_id', $user_id)->delete();
        }

        $like_count = Like::where('note_id', $note_id)->count();

        return response()->json($like_count);
    }
}
