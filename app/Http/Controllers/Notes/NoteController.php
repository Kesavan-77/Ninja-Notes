<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Markdown;
use App\Models\Note;
use App\Models\User;
use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Facades\Vonage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::with('user')->latest('updated_at')->paginate(5);
        return view('notes.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:250',
            'description' => 'required'
        ]);

        Note::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect('/notes')->with('success', "Note created Successfully");;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        // if($note->user_id!=Auth::id()){
        //     return abort(403);
        // }
        // $note = Note::where('uuid',$id)->where('user_id',Auth::id())->firstOrFail();
        $markdown = Markdown::with('user')->where('note_id',$note->id)->get();
        return view('notes.show', ['note' => $note, 'auth_id' => Auth::id(), 'markdown'=>$markdown]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return view('notes.edit')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|max:250',
            'description' => 'required'
        ]);

        $note->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return to_route('notes.show', $note)->with('success', "Note updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return to_route('notes.index')->with('success', "Note deleted Successfully");
    }
}
