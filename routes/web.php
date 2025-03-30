<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Models\Company;

// Route pour la page d'accueil
Route::get('/', function () {
return view('home'); 
})->name('home');

// Route pour la page de connexion
//Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [LoginController::class, 'login']);
//Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


Route::resource('companies', CompanyController::class)->parameters([
    'companies' => 'company:id_company'
]);

Route::get('companies/{company}', [CompanyController::class, 'show'])->name('companies.show');


Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
});