<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/accueil', function () {
    return view('accueil'); // La vue pour l'accueil
})->name('accueil');

Route::get('/w_offres', function () {
    return view('partials.w_offres'); // La vue pour "Mes offres"
})->name('w_offres');

Route::get('offres', function () {  
    return view('offres'); // La vue pour les offres
})->name('offres');

Route::get('/wishlist', function () {
    return view('partials.wishlist'); // La vue pour "Mes favoris"
})->name('wishlist');

Route::get('/w_candidatures', function () {
    return view('partials.w_candidatures'); // La vue pour "Mes candidatures"
})->name('w_candidatures');

Route::get('/offre/{id}', function ($id) {
    // Traite l'offre en fonction de l'id
    return view('offre-details', compact('id')); // Passe l'id à la vue
})->name('offre.details');

Route::get('/informations-legales', function () {
    return view('info'); // Vue pour les informations légales
})->name('info');

Route::get('/cgu', function () {
    return view('cgu'); // Vue pour les CGU
})->name('cgu');

Route::get('/aide_contact', function () {
    return view('aide_contact'); // Vue pour l'aide et contact
})->name('aide_contact');
