<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['users' => User::with('historic.author')->get()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/users', function (Request $request) {
        User::query()->create($request->all());
        return back();
    })->name('users.store');

    Route::get('/users/{user}', function (User $user) {
        return view('user', ['user' => $user]);
    })->name('users.show');

    Route::post('/users/{user}', function (User $user, Request $request) {
        $user->fill($request->all())->save();
        return to_route('dashboard');
    })->name('users.update');

    Route::get('/users/{user}/delete', function (User $user) {
        $user->delete();
        return to_route('dashboard');
    })->name('users.delete');
});

require __DIR__ . '/auth.php';
