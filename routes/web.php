<?php
 
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ChirpInteractionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
 
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

// Rutas para interacciones de chirps
Route::middleware('auth')->group(function () {
    Route::post('/chirps/{chirp}/like', [ChirpInteractionController::class, 'toggleLike'])->name('chirps.like');
    Route::post('/chirps/{chirp}/share', [ChirpInteractionController::class, 'toggleShare'])->name('chirps.share');
    Route::post('/chirps/{chirp}/comment', [ChirpInteractionController::class, 'addComment'])->name('chirps.comment');
    Route::delete('/comments/{comment}', [ChirpInteractionController::class, 'deleteComment'])->name('comments.destroy');
});
 
require __DIR__.'/auth.php';