<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PostulationController;


// Route pour la page d'accueil avec '/'
Route::get('/', function () {
    return view('home');
})->name('home');

// Route pour la page d'accueil avec '/home'
Route::get('home', function () {
    return view('home');
});

// Route pour la page de connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Entreprises
Route::resource('companies', CompanyController::class);


//Route::get('companies/{id_company}', [CompanyController::class, 'show'])->name('companies.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // List users
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Show create form
    Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Store new user
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show'); // Show user details
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Show edit form
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // Update user
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Delete user
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

Route::get('evaluations/create/{company}', [EvaluationController::class, 'create'])->name('evaluations.create');
Route::post('evaluations/store', [EvaluationController::class, 'store'])->name('evaluations.store');
Route::get('evaluations/{company}', [EvaluationController::class, 'index'])->name('evaluations.index');
Route::delete('evaluations/{evaluation}', [EvaluationController::class, 'destroy'])->name('evaluations.destroy');

Route::view('/Informations-legales', 'balekenvrai.Informations-Légales')->name('Informations-legales');
Route::view('/Politique de confidentialité', 'balekenvrai.Politique-de-confidentialité')->name('Politique de confidentialité');
Route::view('/Contact', 'Contact.Contact')->name('Contact');
// Offres 
Route::prefix('offers')->name('offers.')->group(function () {
    Route::get('/', [OfferController::class, 'index'])->name('index'); // Affiche la liste des offres 
    Route::get('/{id}', [OfferController::class, 'show'])->name('show'); // Affiche les détails d'une offre
});

// Candidatures
Route::prefix('postulations')->name('postulations.')->middleware('auth')->group(function () {
    Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist'); // Affiche les candidatures liées à une wishlist
    Route::get('/{id}/manage', [PostulationController::class, 'manage'])->name('manage'); // Page de gestion candidature
    Route::put('/{id}', [PostulationController::class, 'update'])->name('update'); // Mise à jour d'une candidature
    Route::delete('/{id}', [PostulationController::class, 'destroy'])->name('delete'); // Suppression d'une candidature
    Route::post('/offer/{id}/apply', [PostulationController::class, 'store'])->name('apply'); // Soumettre une candidature
    Route::get('/create/{id}', [PostulationController::class, 'create'])->name('postulation.create');
    Route::post('/{id}/store', [PostulationController::class, 'store'])->name('postulation.store');
});

// Wishlist (authentification requise)
Route::middleware('auth')->prefix('wishlist')->name('wishlist.')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index'); // Affiche la wishlist 
    Route::post('/add', [WishlistController::class, 'add'])->name('add'); // Ajoute une offre à la wishlist
    Route::post('/remove', [WishlistController::class, 'remove'])->name('remove'); // Retire une offre de la wishlist
    Route::get('/{id}', [WishlistController::class, 'show'])->name('show'); // Détails d'une offre dans la wishlist 
});

// Page "mes favoris"
Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists.index'); // Afficher la wishlist
Route::get('/wishlists/show', [WishlistController::class, 'show'])->name('wishlists.show');
Route::post('/postuler', [PostulationController::class, 'postuler'])->name('postuler');

// Afficher le formulaire de postulation
Route::get('/offer/{id}/apply', [PostulationController::class, 'create'])->name('postulation.create');

// Soumettre la postulation
Route::post('/offer/{id}/apply', [PostulationController::class, 'store'])->name('postulation.store');
// Route pour afficher la wishlist (les candidatures)
Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist');

