<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belong extends Model
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
        'offer_id',
        'wishlist_id',
    ];

    /**
     * Define the relationship with the Offer model.
     */
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    /**
     * Define the relationship with the Wishlist model.
     */
    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }
}