<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $users = User::when($query, function($q) use ($query) {
            $q->where('name', 'like', "%$query%")->orWhere('email', 'like', "%$query%");
        })->paginate(10);
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'sometimes|in:user,admin' // Ensure role is validated
        ]);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created!');
    }

    public function updateRole(Request $request, User $user)
    {
        // Server-side validation to prevent an admin from demoting themselves
        if (auth()->user()->id === $user->id) {
            abort(403, 'ACTION FORBIDDEN: You cannot change your own role.');
        }

        // Validate the incoming request
        $validated = $request->validate([
            'role' => ['required', Rule::in(['user', 'admin'])],
        ]);

        // Update the user's role
        $user->update([
            'role' => $validated['role'],
        ]);

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User role has been updated successfully.');
    }
    
    // public function update(Request $request, User $user)
    // {
    //     $this->authorize('update', $user); // Assuming a policy or admin check
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    //         'role' => 'required|in:user,admin',
    //     ]);
    //     $user->update($validated);
    //     return redirect()->route('users.index')->with('success', 'User updated!');
    // }

}