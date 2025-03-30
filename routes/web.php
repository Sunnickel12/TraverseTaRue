<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\WishlistController;

Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');

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

Route::middleware(['auth'])->group(function () {
    Route::get('/postuler/{id_offers}', [PostulationController::class, 'create'])->name('postulation.create');
    Route::post('/postuler/{id_offers}', [PostulationController::class, 'store'])->name('postulation.store');
});