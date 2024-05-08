<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


/**
 * @explain: Jednotlivé stránky
 */
Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');  

// @todo: zeptat se chata jak to dělat když potřebuju na stránku data z více zdrojů (např. posts a collections, nebo posts a users to follow)


Route::get('/settings', function () {
    return Inertia::render('Settings/Index');
})->middleware(['auth', 'verified'])->name('settings');

// Route::middleware('auth')->group(function () {
//     Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
    
//     Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
// });


Route::middleware('auth')->group(function () { // @change: Tyto routes budou součástí settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
