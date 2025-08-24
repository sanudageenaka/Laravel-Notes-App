<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    public function view(User $user, Note $note): bool
    {
        return $user->role === 'admin' || $user->id === $note->user_id;
    }

    public function update(User $user, Note $note): bool
    {
        return $user->role === 'admin' || $user->id === $note->user_id;
    }

    public function delete(User $user, Note $note): bool
    {
        return $user->role === 'admin' || $user->id === $note->user_id;
    }
}