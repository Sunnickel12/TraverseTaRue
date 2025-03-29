<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends Model
{
    use HasFactory;

    // Spécifier les attributs pouvant être assignés en masse
    protected $fillable = [
        'name',
        'id_country',
    ];

    /**
     * Une relation de type "Une région appartient à un pays".
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'id_country');
    }
}
