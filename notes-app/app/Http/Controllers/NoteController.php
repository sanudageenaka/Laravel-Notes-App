<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('search');
        if ($user->role === 'admin') {
            $notes = Note::with('user')->when($query, function($q) use ($query) { // Eager load the user
                $q->where('title', 'like', "%$query%")->orWhere('content', 'like', "%$query%");
            })->paginate(10);
        } else {
            $notes = $user->notes()->with('user')->when($query, function($q) use ($query) { // Eager load the user
                $q->where('title', 'like', "%$query%")->orWhere('content', 'like', "%$query%");
            })->paginate(10);
        }
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $request->user()->notes()->create($validated);

        return redirect()->route('notes.index')->with('success', 'Note created!');
    }

    public function show(Note $note)
    {
        $this->authorize('view', $note);
        return view('notes.show', compact('note'));
    }

   public function edit(Note $note)
    {
        $this->authorize('update', $note); // Corrected from 'view' to 'update'
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);  // Change to 'update' for accuracy

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')->with('success', 'Note updated!');
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted!');
    }
}