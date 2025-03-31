<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PostulationController;

//Route pour la wishlist
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

Route::get('/w_candidatures', [WishlistController::class, 'candidatures'])->name('w_candidatures');
// Route pour afficher la wishlist (les candidatures)
Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist');

Route::post('/postuler', [PostulationController::class, 'postuler'])->name('postuler');

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
Route::get('/postulations/{id_postulation}/manage', [PostulationController::class, 'manage'])->name('postulation.manage');
Route::delete('/postulations/{id_postulation}', [PostulationController::class, 'destroy'])->name('postulation.delete');
Route::put('/postulations/{id_postulation}', [PostulationController::class, 'update'])->name('postulation.update');


Route::get('/w_candidatures', [PostulationController::class, 'wishlist'])->name('w_candidatures');

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
Route::get('/w_offres', function () {
    return view('partials.w_offres'); // La vue pour "Mes offres"
})->name('w_offres');

// Afficher le formulaire de postulation
Route::get('/offer/{id_offers}/apply', [PostulationController::class, 'create'])->name('postulation.create');

// Soumettre la postulation
Route::post('/offer/{id_offers}/apply', [PostulationController::class, 'store'])->name('postulation.store');




// Route::get('postulations/{id_postulation}/edit', [PostulationController::class, 'edit'])->name('postulations.edit');

// Route::put('/postulations/{id_postulation}/update', [PostulationController::class, 'update'])->name('postulations.update');
// Route::delete('/postulations/{id_postulation}', [PostulationController::class, 'destroy'])->name('postulations.destroy');
// Route::get('/wishlist', function () {
//     return view('partials.wishlist'); // La vue pour "Mes favoris"
// })->name('wishlist');
