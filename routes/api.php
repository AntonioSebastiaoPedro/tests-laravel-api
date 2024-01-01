<?php

use App\Http\Controllers\{PermissionController, UserController};
use App\Http\Controllers\Auth\AuthApiController;
use App\Http\Controllers\PermissionUserController;
use Illuminate\Support\Facades\Route;

Route::post('/auth', [AuthApiController::class, 'auth'])->name('auth.login');

Route::middleware(['auth:sanctum', 'acl'])->group(function () {
    Route::get('/me', [AuthApiController::class, 'me'])->name('auth.me');
    Route::post('/logout', [AuthApiController::class, 'logout'])->name('auth.logout');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::apiResource('permissions', PermissionController::class);

    Route::post('/users/{user}/permissions-sync', [PermissionUserController::class, 'syncPermissionsUser'])->name('permissions-sync');
    Route::get('/users/{user}/permissions', [PermissionUserController::class, 'getPermissionsUser'])->name('users.permissions');
});
