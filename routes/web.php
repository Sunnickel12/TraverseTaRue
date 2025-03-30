<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PostulationController;


Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
});


Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('partials.home-page'); // La vue pour l'accueil
})->name('home');

Route::get('/w_offres', function () {
    return view('partials.w_offres'); // La vue pour "Mes offres"
})->name('w_offres');

Route::get('/offres', [OfferController::class, 'index'])->name('offres');

Route::get('/wishlist', function () {
    return view('partials.wishlist'); // La vue pour "Mes favoris"
})->name('wishlist');

Route::get('/w_candidatures', function () {
    return view('partials.w_candidatures'); // La vue pour "Mes candidatures"
})->name('w_candidatures');

Route::get('/offres', [OfferController::class, 'index'])->name('offres');
Route::get('/offre/{id_offers}', [OfferController::class, 'show'])->name('offres.show');


Route::get('/informations-legales', function () {
    return view('info'); // Vue pour les informations légales
})->name('info');

Route::get('/cgu', function () {
    return view('cgu'); // Vue pour les CGU
})->name('cgu');

Route::get('/aide_contact', function () {
    return view('aide_contact'); // Vue pour l'aide et contact
})->name('aide_contact');

// Afficher le formulaire de postulation
Route::get('/offer/{id_offers}/apply', [PostulationController::class, 'create'])->name('postulation.create');

// Soumettre la postulation
Route::post('/offer/{id_offers}/apply', [PostulationController::class, 'store'])->name('postulation.store');
// Route pour afficher la wishlist (les candidatures)
Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist');

Route::post('/postuler', [PostulationController::class, 'postuler'])->name('postuler');
/*
Route::get('postulations/{id_postulation}/edit', [PostulationController::class, 'edit'])->name('postulations.edit');

Route::put('/postulations/{id_postulation}/update', [PostulationController::class, 'update'])->name('postulations.update');
Route::delete('/postulations/{id_postulation}', [PostulationController::class, 'destroy'])->name('postulations.destroy');

*/