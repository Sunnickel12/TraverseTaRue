<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    // Spécifier les attributs pouvant être assignés en masse
    protected $fillable = [
        'name',
    ];

    /**
     * Une relation de type "Un pays a plusieurs régions".
     */
    public function regions(): HasMany
    {
        return $this->hasMany(Region::class, 'id_country');
    }
}
