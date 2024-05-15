<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AvatarController;
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


// Route::get('/settings', function () {
//     return Inertia::render('Settings/Index');
// })->middleware(['auth', 'verified'])->name('settings');


// Route::get('/settings/profile', function () {

// });

// Zobrazení profilu
Route::get('/user/{user:username}', [ProfileController::class, 'show'])
    ->name('profile.show')
    ->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::name('settings')->group(function () {
        
        Route::get('/settings', function () {
            return Inertia::render('Settings/Index');
        });

        Route::get('/settings/profile', [ProfileController::class, 'edit'])->name('.profile.edit');
        Route::patch('/settings/profile', [ProfileController::class, 'update'])->name('.profile.update');
        
        Route::get('/settings/remove-account', function () {
            return Inertia::render('Settings/YourAccount/RemoveAccount');
        })->name('.remove-account');

        Route::delete('/settings/profile', [ProfileController::class, 'destroy'])->name('.profile.destroy');
        Route::get('/settings/password', function () {
            return Inertia::render('Settings/YourAccount/ChangePassword');
        })->name('.password.edit');
        
        Route::post('/avatar/upload', [AvatarController::class, 'upload'])->name('.avatar.upload');
        Route::delete('/avatar/delete', [AvatarController::class, 'delete'])->name('.avatar.delete');

    });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
    
//     Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
// });


// Route::middleware('auth')->group(function () { // @change: Tyto routes budou součástí settings
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
