<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

Route::get('login/{driver}', [SocialAuthController::class, 'redirectToProvider']);
Route::get('login/{driver}/callback', [SocialAuthController::class, 'handleProviderCallback']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::resource('posts', PostController::class);
    Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.index');
});


   


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});