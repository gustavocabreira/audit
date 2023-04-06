<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): View
    {
        return view('dashboard', ['users' => User::with('historic.author')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::query()->create($validated);
        return back();
    }

    public function show(User $user): View
    {
        return view('user', ['user' => $user]);
    }

    public function update(User $user, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
        ]);

        $user->fill($validated)->save();
        return to_route('dashboard');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return to_route('dashboard');
    }
}
