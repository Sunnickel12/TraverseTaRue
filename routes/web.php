<?php

use Illuminate\Support\Facades\Route;

// Route pour la page d'accueil
Route::get('/', function () {
    return view('home'); // Retourne directement la vue 'home.blade.php'
})->name('home');