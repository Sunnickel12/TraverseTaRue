<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companie extends Model
{
    use HasFactory;

    // Nom de la table dans la base de données
    protected $table = 'companie';

    // Colonnes autorisées pour l'insertion en masse
    protected $fillable = ['nom', 'description', 'logo'];
}