<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserSettingsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'],function () {

    // Home routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard')
        ->middleware("auth");

    // Log routes
    Route::get('/logs', [LogController::class, 'index'])->name('logsHome')
        ->middleware("auth");
    Route::get('/logs/create', [LogController::class, 'create'])->name('createLog')
        ->middleware("auth");
    Route::post('/logs/create', [LogController::class, 'store'])->name('createLog')
        ->middleware("auth");
    Route::get('/logs/{logSlug}', [LogController::class, 'show'])->name('showLog')
        ->middleware("auth");
    Route::get('/logs/edit/{logSlug}', [LogController::class, 'edit'])->name('editLog')
        ->middleware("auth");
    Route::patch('/logs/update/{logSlug}', [LogController::class, 'update'])->name('updateLog')
        ->middleware("auth");
    Route::get('/logs/delete/{logSlug}', [LogController::class, 'delete'])->name('deleteLog')
        ->middleware("auth");
    Route::delete('/logs/delete/{logSlug}', [LogController::class, 'destroy'])->name('destroyLog')
        ->middleware("auth");

    // Client routes
    Route::get('/clients', [ClientController::class, 'index'])->name('clientsHome')
        ->middleware("auth");
    Route::get('/clients/create', [ClientController::class, 'create'])->name('createClient')
        ->middleware("auth");
    Route::post('/clients/create', [ClientController::class, 'store'])->name('createClient')
        ->middleware("auth");
    Route::get('/clients/{clientSlug}', [ClientController::class, 'show'])->name('showClient')
        ->middleware("auth");
    Route::get('/clients/edit/{logSlug}', [ClientController::class, 'edit'])->name('editClient')
        ->middleware("auth");
    Route::patch('/clients/update/{logSlug}', [ClientController::class, 'update'])->name('updateClient')
        ->middleware("auth");
    Route::delete('/clients/delete/{logSlug}', [ClientController::class, 'destroy'])->name('destroyClient')
        ->middleware("auth");

    // User routes
    Route::get('/users', [UserController::class, 'index'])->name('usersHome')
        ->middleware("auth");
    Route::get('/users/create', [UserController::class, 'create'])->name('createUser')
        ->middleware("auth");
    Route::post('/users/create', [UserController::class, 'store'])->name('createUser')
        ->middleware("auth");
    Route::get('/users/{user}', [UserController::class, 'show'])->name('showUser')
        ->middleware("auth");
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('editUser')
        ->middleware("auth");
    Route::patch('/users/update/{user}', [UserController::class, 'update'])->name('updateUser')
        ->middleware("auth");
    Route::get('/users/delete/{user}', [UserController::class, 'delete'])->name('deleteUser')
        ->middleware("auth");
    Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('destroyUser')
        ->middleware("auth");

    // User settings routes
    Route::get('/settings', [UserSettingsController::class, 'edit'])->name('editSettings')
        ->middleware("auth");
    Route::put('/settings/update', [UserSettingsController::class, 'update'])->name('updateSettings')
        ->middleware("auth");

    // Auth routes
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout')
        ->middleware("auth");
});

// Auth routes
Route::get('/', [LoginController::class, 'create'])->name('login')
    ->middleware("guest");
Route::post('/login', [LoginController::class, 'store'])
    ->middleware("guest");
Route::get('/forgot', [ResetPasswordController::class, 'create'])
    ->middleware("guest");
