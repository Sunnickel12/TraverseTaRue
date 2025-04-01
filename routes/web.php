<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PostulationController;

// Page d'accueil
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Entreprises
Route::resource('companies', CompanyController::class);

// Offres 
Route::prefix('offers')->name('offers.')->group(function () {
    Route::get('/', [OfferController::class, 'index'])->name('index'); // Affiche la liste des offres 
    Route::get('/{offer}', [OfferController::class, 'show'])->name('show'); // Affiche les détails d'une offre
});

// Candidatures
Route::prefix('postulations')->name('postulations.')->middleware('auth')->group(function () {
    Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist'); // Affiche les candidatures liées à une wishlist
    Route::get('/{id}/manage', [PostulationController::class, 'manage'])->name('manage'); // Page de gestion candidature
    Route::put('/{id}', [PostulationController::class, 'update'])->name('update'); // Mise à jour d'une candidature
    Route::delete('/{id}', [PostulationController::class, 'destroy'])->name('delete'); // Suppression d'une candidature
    Route::post('/offer/{id}/apply', [PostulationController::class, 'store'])->name('apply'); // Soumettre une candidature
});

// Wishlist (authentification requise)
Route::middleware('auth')->prefix('wishlist')->name('wishlist.')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index'); // Affiche la wishlist 
    Route::post('/add', [WishlistController::class, 'add'])->name('add'); // Ajoute une offre à la wishlist
    Route::post('/remove', [WishlistController::class, 'remove'])->name('remove'); // Retire une offre de la wishlist
    Route::get('/{id}', [WishlistController::class, 'show'])->name('show'); // Détails d'une offre dans la wishlist 
});

Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists.index'); // Afficher la wishlist
Route::post('/postuler', [PostulationController::class, 'postuler'])->name('postuler');

// Afficher le formulaire de postulation
Route::get('/offer/{id}/apply', [PostulationController::class, 'create'])->name('postulation.create');

// Soumettre la postulation
Route::post('/offer/{id}/apply', [PostulationController::class, 'store'])->name('postulation.store');
// Route pour afficher la wishlist (les candidatures)
Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist');

