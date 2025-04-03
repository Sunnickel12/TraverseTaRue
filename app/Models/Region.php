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
        'country_id',
    ];

    /**
     * Une relation de type "Une région appartient à un pays".
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
