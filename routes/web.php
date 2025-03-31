<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Route pour la page d'accueil
Route::get('/', function () {
    return view('home');
})->name('home');

// Route pour la page de connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
