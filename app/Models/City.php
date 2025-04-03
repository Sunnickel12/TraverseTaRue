<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'situates', 'city_id', 'company_id');
    }
}
