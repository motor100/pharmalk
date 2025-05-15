<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CouponController;

Route::get('/', function () {
    return redirect('/login');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [MainController::class, 'home'])->name('dashboard');

    Route::get('/orders', [MainController::class, 'orders']);

    // Coupon
    Route::get('/coupon', [CouponController::class, 'index'])->name('coupon');

    Route::get('/coupon/create', [CouponController::class, 'create'])->name('coupon-create');

    Route::post('/coupon/store', [CouponController::class, 'store'])->name('coupon-store');

    Route::get('coupon/{id}/edit', [CouponController::class, 'edit'])->name('coupon-edit');

    Route::post('/coupon/{id}/update', [CouponController::class, 'update'])->name('coupon-update');

    Route::get('/coupon/{id}/destroy', [CouponController::class, 'destroy'])->name('coupon-destroy');


    Route::get('/notifications', [MainController::class, 'notifications']);

    Route::get('/knowledge-base', [MainController::class, 'knowledge_base']);

    Route::get('/support', [MainController::class, 'support']);

    // Ajax
    Route::get('/ajax/aside-nav-set-active', [AjaxController::class, 'aside_nav_set_active']);

    Route::get('/ajax/aside-nav-remove-active', [AjaxController::class, 'aside_nav_remove_active']);

    Route::get('/ajax/orders-summ-calc', [AjaxController::class, 'orders_summ_calc']);
});

// Route::get('/', [MainController::class, 'home'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
