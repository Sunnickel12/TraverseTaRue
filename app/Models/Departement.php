<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departements'; // Nom de la table

    protected $primaryKey = 'id_departement'; // Clé primaire personnalisée

    public $timestamps = true; // Active les timestamps (created_at, updated_at)

    protected $fillable = [
        'name',
        'id_region'
    ];

    /**
     * Relation avec la région (Un département appartient à une seule région)
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region', 'id_region');
    }

    /**
     * Relation avec les villes (Un département a plusieurs villes)
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'id_departement', 'id_departement');
    }
}
