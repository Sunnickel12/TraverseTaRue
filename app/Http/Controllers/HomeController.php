<?php

namespace App\Http\Controllers;

use App\Models\Companie; // Assurez-vous que le modèle Companie existe
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer toutes les entreprises depuis la table companie
        $entreprises = Companie::all();

        // Passer les entreprises à la vue
        return view('home', compact('entreprises'));
    }
}