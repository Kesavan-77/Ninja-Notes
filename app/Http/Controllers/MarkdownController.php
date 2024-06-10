<?php

namespace App\Http\Controllers;

use App\Models\Markdown;
use App\Models\Note;
use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarkdownController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'markdown' => 'required',
        ]);

        $markdown = $request->markdown;
        $noteId = $request->noteId;
        $userId = Auth::id();

        Markdown::create([
            'note_id' => $noteId,
            'user_id' => $userId,
            'markdown' => $markdown
        ]);

        $note = Note::with('user')->find($noteId);

        if ($note && $note->user && $note->user->id != Auth::id()) {
            $userId = $note->user->id;
            $userName = Auth::user()->name;
            $message = 'has markdowned on your note ' . $note->title;
            $note->user->notify(new UserFollowNotification($userId, $userName, $message));
        }

        return redirect('/notes');
    }
}
