<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ContactController;


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


// Route pour la page de création d'une entreprise
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
