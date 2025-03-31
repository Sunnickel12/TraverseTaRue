<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;

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
