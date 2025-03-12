<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/accueil', function () {
    return view('accueil'); // La vue pour l'accueil
})->name('accueil');

Route::get('/mes_offres', function () {
    return view('mes_offres'); // La vue pour "Mes offres"
})->name('mes_offres');

Route::get('/wishlist', function () {
    return view('partials.wishlist'); // La vue pour "Wishlist"
})->name('wishlist');

Route::get('/mes_candidatures', function () {
    return view('mes_candidatures'); // La vue pour "Mes candidatures"
})->name('mes_candidatures');

Route::get('/informations-legales', function () {
    return view('info'); // Vue pour les informations légales
})->name('info');

Route::get('/cgu', function () {
    return view('cgu'); // Vue pour les CGU
})->name('cgu');

Route::get('/aide_contact', function () {
    return view('aide_contact'); // Vue pour l'aide et contact
})->name('aide_contact');
