<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route pour la page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');