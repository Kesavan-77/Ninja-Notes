<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashController extends Controller
{
    public function index(){

        $trashs = Note::with('user')->where('user_id',Auth::id())->onlyTrashed()->paginate(3);

        return view('notes.trash')->with('trashs',$trashs);
    }

    public function restore($id){
        $trashs = Note::onlyTrashed()->find($id);
        $trashs->restore();
        return redirect('/trash')->with('success','Note restored successfully');
    }

    public function destroy($id){
        $trashs = Note::onlyTrashed()->find($id);
        $trashs->forceDelete();

        return redirect('/trash')->with('success','Note deleted successfully');
    }
}