<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        return view('dashboard.users.index', [
            'users' => $users,
        ]);
    }
    public function create()
    {
        return view('dashboard.users.edit', [
            'user' => new User(),
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:4', 'max:255'],
        ]);
        $user = User::create($validated);
        if ($user) {
            return redirect(route('dashboard.users.edit', $user))->with('status', __('User :name saved.', [
                'name' => $user->name,
            ]));
        } else {
            return back()->withErrors([
                'status' => __('Create user failed!'),
            ]);
        }
    }
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'user' => $user,
        ]);
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($user?->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)],
        ]);
        $save = $user->update($validated);
        if ($save) {
            return back()->with('status', __('User :name saved.', [
                'name' => data_get($validated, 'name'),
            ]));
        } else {
            return back()->withErrors([
                'status' => __('Save user failed!'),
            ]);
        }
    }
    public function delete(User $user)
    {
        $delete = $user->delete();
        if ($delete) {
            return back()->with('status', __('User :name deleted', [
                'name' => $user->name,
            ]));
        } else {
            return back()->withErrors([
                'status' => __('Delete user failed'),
            ]);
        }
    }

}
