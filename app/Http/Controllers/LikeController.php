<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function count(Request $request){
        $note_id = $request->noteId;
        $like_count = Like::where('note_id',$note_id)->count();

        return response()->json($like_count);
    }
    
    public function manage(Request $request)
    {
        $note_id = $request->noteId;
        $user_id = Auth::id();

        $like = Like::where('note_id',$note_id)->where('user_id',$user_id)->first();

        if(!$like){
            Like::create([
                "note_id" => $note_id,
                "user_id" => $user_id,
                "like" => "liked",
            ]);
        }else{
            Like::where('note_id',$note_id)->where('user_id',$user_id)->delete();
        }

        $like_count = Like::where('note_id',$note_id)->count();

        return response()->json($like_count);
    }
}

