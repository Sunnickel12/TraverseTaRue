<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies'; // Définir la table (si nécessaire)
    protected $fillable = [
        'id_companies', 
        'name', 
        'city', 
        'address', 
        'description', 
        'logo'
    ];

    public $timestamps = false; // Désactiver les timestamps si ta table n'a pas created_at / updated_at
}