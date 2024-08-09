<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Todo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('todos', compact('todos'));
    }

    public function store(Request $request, $todoId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('notes.show', ['todo' => $todoId])->withErrors($validator);
        }

        Note::create([
            'content' => $request->get('content'),
            'todo_id' => $todoId,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('notes.show', ['todo' => $todoId])->with('success', 'Note added successfully.');
    }

    public function edit(string $todoId)
    {
        $note = Note::where('id', $todoId)->first();
        return view('edit-note', ['note' => $note]);
    }

    public function update(Request $request, string $noteId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('todos.index')->withErrors($validator);
        }


        $note = Note::findOrFail($noteId);
        $note->content = $request->input('content');
        $note->save();

        $todoId = $note->todo_id;

        return redirect()->route('notes.show', ['todo' => $todoId])->with('success', 'Note added successfully.');
    }

    public function destroy(string $todoId, string $noteId)
    {
        Note::where('id', $noteId)->delete();
        return redirect()->route('notes.show', ['todo' => $todoId])->with('success', 'Note added successfully.');
    }

    public function show($todo)
    {
        $todo = Todo::findOrFail($todo);

        // sort oldest to newest
        $todo->load(['notes' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('notes', ['todo' => $todo]);
    }
    // W modelu Note.php
    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }


}
