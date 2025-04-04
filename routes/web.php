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
use App\Http\Controllers\CityController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CountryController;

// Home & Static Pages
Route::view('/', 'home')->name('home');
Route::view('home', 'home');
Route::view('/Informations-legales', 'footer.Legal-information')->name('Informations-legales');
Route::view('/Politique-de-confidentialité', 'footer.Privacy-policy')->name('Politique de confidentialité');
Route::view('/Contact', 'contact.contact')->name('Contact');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// User Routes (auth required)
Route::middleware(['auth'])->group(function () {
    Route::view('/Profil', 'users.dashboard')->name('dashboard');
    Route::resource('users', UserController::class);
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

// Company Routes
Route::resource('companies', CompanyController::class);

// Evaluation Routes
Route::prefix('evaluations')->group(function () {
    Route::get('create/{company}', [EvaluationController::class, 'create'])->name('evaluations.create');
    Route::post('store', [EvaluationController::class, 'store'])->name('evaluations.store');
    Route::get('{company}', [EvaluationController::class, 'index'])->name('evaluations.index');
    Route::delete('{evaluation}', [EvaluationController::class, 'destroy'])->name('evaluations.destroy');
});

// Offer Routes
Route::resource('offers', OfferController::class);

// Postulation Routes (auth required)
Route::middleware('auth')->group(function () {
    Route::resource('postulations', PostulationController::class)->except(['show', 'index']);
    Route::get('/postulations/download/{type}/{id}', [PostulationController::class, 'download'])->name('postulations.download');
});

// Wishlist Routes (auth required)
Route::middleware('auth')->prefix('wishlist')->name('wishlist.')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/add', [WishlistController::class, 'add'])->name('add');
    Route::post('/remove', [WishlistController::class, 'remove'])->name('remove');
    Route::get('/{id}', [WishlistController::class, 'show'])->name('show');
});
Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists.index');

// Admin Panel Routes (auth required)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::view('/Panneau_de_Configuration', 'admin.Pannel')->name('Panneau_de_Configuration');
    Route::resource('cities', CityController::class);
    Route::resource('departements', DepartementController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('countries', CountryController::class);
    Route::get('/manage-users', [UserController::class, 'index'])->name('admin.manage-users');

    // Contact Management (Admin)
    Route::prefix('support')->name('admin.support.')->group(function () {
        Route::get('/index', [ContactController::class, 'adminContacts'])->name('index');
        Route::get('/{contact}', [ContactController::class, 'show'])->name('show');
        Route::put('/{contact}', [ContactController::class, 'update'])->name('update');
        Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('destroy');
        Route::post('/{contact}/status', [ContactController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/download/{contactId}', [ContactController::class, 'download'])->name('download');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::delete('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

// Autres routes (exemple pour dashboard optionnel)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/{id?}', [UserController::class, 'dashboard'])->name('users.dashboard');
});

// Routes Contact (public ou auth selon vos besoins)
Route::prefix('contact')->group(function () {
    Route::post('/', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/success', [ContactController::class, 'success'])->name('contact.success');
    Route::get('/download/{contactId}', [ContactController::class, 'download'])->name('contact.download');
});
