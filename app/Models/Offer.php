<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'salary', 'id_city', 'id_companie', 'created_at'
    ];

    // Custom primary key
    protected $primaryKey = 'id_offer';

    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Get the company that owns the offer.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'id_companie');
    }

    /**
     * Get the city the offer is located in.
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'id_city');
    }

    public function postulations()
    {
        return $this->hasMany(Postulation::class, 'id_offer', 'id_offer');
    }
}