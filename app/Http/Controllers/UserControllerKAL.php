<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserControllerKAL extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::orderBy('name')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ];

        if (auth()->user()->role === 'admin') {
            $rules['role'] = ['required', 'in:admin,team_member,guest'];
        }

        $data = $request->validate($rules);

        if (auth()->user()->role !== 'admin') {
            unset($data['role']);
        }

        if (auth()->user()->role === 'admin' && $user->id === auth()->id() && isset($data['role']) && $data['role'] !== 'admin') {
            abort(403, 'An administrator cannot demote themselves.');
        }

        if (isset($data['role']) && $user->role === 'admin' && $data['role'] !== 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
                abort(403, 'There must always be at least one admin in the system.');
            }
        }

        $user->update($data);

        return redirect()->route('users.show', $user)->with('status', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        if ($user->role === 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
                abort(403, 'There must always be at least one admin in the system.');
            }
        }

        $user->delete();

        return redirect()->route('users.index')->with('status', 'User deleted successfully.');
    }
}
