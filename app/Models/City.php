<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities'; 
    public $timestamps = true; 

    protected $fillable = [
        'name',
        'departement_id'
    ];

    /**
     * Relation avec le département (Une ville appartient à un seul département)
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');

    }
}
