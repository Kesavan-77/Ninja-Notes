<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Markdown;
use App\Models\Note;
use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MarkdownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/notes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'markdown' => 'required',
            'noteId' => 'required',
        ]);

        $markdown = $request->markdown;
        $noteId = $request->noteId;
        $userId = Auth::id();

        $markdown = Markdown::create([
            'note_id' => $noteId,
            'user_id' => $userId,
            'markdown' => $markdown,
            'uuid' => Str::uuid(),
        ]);

        $note = $markdown->note;
        return redirect('notes/'.$note->uuid)->with('success', "Markdown created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Markdown $markdown)
    {
        return view('notes.markdown-edit')->with('markdown', $markdown);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Markdown $markdown)
    {
        $request->validate([
            'markdown' => 'required'
        ]);

        $markdown->update([
            'markdown' => $request->markdown,
        ]);

        $note = Note::where('id', $markdown->note_id)->first();

        $uuid = $note->uuid;

        return to_route('notes.show', $uuid)->with('success', "markdown updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Markdown $markdown)
    {
        $markdown->delete();

        $note = Note::where('id', $markdown->note_id)->first();

        $uuid = $note->uuid;

        return to_route('notes.show', $uuid)->with('success', "markdown deleted Successfully");
    }
}
