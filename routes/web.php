<?php

use Illuminate\Support\Facades\Route;

// Route pour la page d'accueil
Route::get('/', function () {
    return view('home'); 
})->name('home');