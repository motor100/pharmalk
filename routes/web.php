<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return redirect('/login');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [MainController::class, 'home'])->name('dashboard');

    Route::get('/orders', [MainController::class, 'orders']);

    Route::get('/coupons', [MainController::class, 'coupons']);

    Route::get('/notifications', [MainController::class, 'notifications']);

    Route::get('/knowledge-base', [MainController::class, 'knowledge_base']);

    Route::get('/support', [MainController::class, 'support']);
});

// Route::get('/', [MainController::class, 'home'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
