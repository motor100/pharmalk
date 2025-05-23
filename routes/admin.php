<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(static function () {

    // Guest routes
    Route::middleware('guest:admin')->group(static function () {
        // Auth routes
        Route::get('login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'create'])->name('admin.login');
        Route::post('login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'store']);
        // Forgot password
        Route::get('forgot-password', [\App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'create'])->name('admin.password.request');
        Route::post('forgot-password', [\App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'store'])->name('admin.password.email');
        // Reset password
        Route::get('reset-password/{token}', [\App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'create'])->name('admin.password.reset');
        Route::post('reset-password', [\App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'store'])->name('admin.password.update');
    });

    // Verify email routes
    Route::middleware(['auth:admin'])->group(static function () {
        Route::get('verify-email', [\App\Http\Controllers\Admin\Auth\EmailVerificationPromptController::class, '__invoke'])->name('admin.verification.notice');
        Route::get('verify-email/{id}/{hash}', [\App\Http\Controllers\Admin\Auth\VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('admin.verification.verify');
        Route::post('email/verification-notification', [\App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('admin.verification.send');
    });

    // Authenticated routes
    Route::middleware(['auth:admin'])->group(static function () {
        // Confirm password routes
        Route::get('confirm-password', [\App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'show'])->name('admin.password.confirm');
        Route::post('confirm-password', [\App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'store']);

        // Logout route
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->name('admin.logout');


        // Админ панель
        Route::get('/', [AdminController::class, 'home'])->name('admin.index');

        Route::get('/profile', [ProfileController::class, 'edit'])
                    ->middleware('password.confirm.admin')
                    ->name('admin.profile');

        Route::put('password', [ProfileController::class, 'new_password'])->name('admin.newpassword');

        Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');

        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users');

        Route::get('/users/create', [UserController::class, 'create'])->name('users-create');

        Route::post('/users/store', [UserController::class, 'store'])->name('users-store');

        Route::get('/users/{id}', [UserController::class, 'show'])->name('users-show');

        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users-edit');

        Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users-update');

        Route::get('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users-destroy');

        Route::post('/users/password', [UserController::class, 'password'])->name('users-password');
    
    });
});

