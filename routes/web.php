<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PostulationController;


Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

Route::get('/w_candidatures', [WishlistController::class, 'candidatures'])->name('w_candidatures');


// Route pour la page d'accueil
Route::get('/', function () {

    return view('home');
})->name('home');

// Route pour la page de connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


// Route pour la page de création d'une entreprise
Route::resource('companies', CompanyController::class);

//Route::get('companies/{id_company}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('/postulations/{id}/manage', [PostulationController::class, 'manage'])->name('postulation.manage');
Route::delete('/postulations/{id}', [PostulationController::class, 'destroy'])->name('postulation.delete');
Route::put('/postulations/{id}', [PostulationController::class, 'update'])->name('postulation.update');


Route::get('/w_candidatures', [PostulationController::class, 'wishlist'])->name('w_candidatures');

Route::get('/offers', [OfferController::class, 'index'])->name('offers');
Route::get('/offers/{id}', [OfferController::class, 'show'])->name('offers.show');


Route::get('/w_offers', function () {
    return view('partials.w_offers'); // La vue pour "Mes offers"
})->name('w_offers');
// Afficher le formulaire de postulation
Route::get('/offer/{id}/apply', [PostulationController::class, 'create'])->name('postulation.create');

// Soumettre la postulation
Route::post('/offer/{id}/apply', [PostulationController::class, 'store'])->name('postulation.store');
// Route pour afficher la wishlist (les candidatures)
Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist');

Route::post('/postuler', [PostulationController::class, 'postuler'])->name('postuler');