<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Define extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_offer',
        'id_sector',
    ];

    /**
     * Define the relationship with the Offer model.
     * A define entry links an offer to a sector.
     */
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'id_offer');
    }

    /**
     * Define the relationship with the Sector model.
     * A define entry links a sector to an offer.
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'id_sector');
    }
}