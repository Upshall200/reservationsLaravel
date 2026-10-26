<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Artist - accès public
|--------------------------------------------------------------------------
*/

Route::get('/artist', [ArtistController::class, 'index'])
    ->name('artist.index');

Route::get('/artist/{id}', [ArtistController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('artist.show');

/*
|--------------------------------------------------------------------------
| Routes protégées par authentification
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Profile Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Artist
    Route::get('/artist/create', [ArtistController::class, 'create'])
        ->name('artist.create');

    Route::post('/artist', [ArtistController::class, 'store'])
        ->name('artist.store');

    Route::get('/artist/edit/{id}', [ArtistController::class, 'edit'])
        ->where('id', '[0-9]+')
        ->name('artist.edit');

    Route::put('/artist/{id}', [ArtistController::class, 'update'])
        ->where('id', '[0-9]+')
        ->name('artist.update');

    Route::delete('/artist/{id}', [ArtistController::class, 'destroy'])
        ->where('id', '[0-9]+')
        ->name('artist.delete');
});

require __DIR__.'/auth.php';