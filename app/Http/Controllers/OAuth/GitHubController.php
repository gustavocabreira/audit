<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

class GitHubController extends Controller
{
    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function gitCallback(): \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
    {
        $user = Socialite::driver('github')->user();

        $searchUser = User::query()->where('github_id', $user->id)->first();

        if ($searchUser) {
            Auth::login($searchUser);
            return redirect('/dashboard');
        }

        $gitUser = User::query()->updateOrCreate([
            'email' => $user->email
        ], [
            'name' => $user->name,
            'email' => $user->email,
            'github_id' => $user->id,
            'auth_type' => 'github',
            'password' => encrypt('gitpwd059'),
        ]);

        Password::sendResetLink(
            ['email' => $user->email]
        );

        Auth::login($gitUser);

        return redirect('/dashboard');
    }
}
