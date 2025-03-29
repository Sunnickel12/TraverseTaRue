<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities'; // Nom de la table

    protected $primaryKey = 'id_city'; // Clé primaire personnalisée

    public $timestamps = true; // Active les timestamps (created_at, updated_at)

    protected $fillable = [
        'name',
        'id_departement'
    ];

    /**
     * Relation avec le département (Une ville appartient à un seul département)
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }
}
