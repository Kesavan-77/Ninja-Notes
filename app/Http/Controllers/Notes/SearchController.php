<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchNote(Request $request){
        $note = Note::with('user')->where('title', 'like', '%' . $request->search . '%')->get();
        return response()->json($note);
    }
}
