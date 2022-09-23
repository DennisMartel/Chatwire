<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\PostController;

Route::get('login/{driver}', [SocialAuthController::class, 'redirectToProvider']);
Route::get('login/{driver}/callback', [SocialAuthController::class, 'handleProviderCallback']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::resource('posts', PostController::class);
});


   


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});