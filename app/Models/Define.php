<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Define extends Model
{
    use HasFactory;

    
    public $timestamps = false;

    
    protected $fillable = [
        'id_offer',
        'id_sector',
    ];

    /**
     * Define the relationship with the Offer model.
     */
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'id_offer');
    }

    /**
     * Define the relationship with the Sector model.
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'id_sector');
    }
}