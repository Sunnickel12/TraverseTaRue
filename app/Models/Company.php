<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'description',
        'logo',
        'email',
        'phone'
    ];

    // Relation many-to-many avec City
    public function cities()
    {
        return $this->belongsToMany(City::class, 'situates', 'company_id', 'city_id');
    }

    public function isAddressInCity($cityName)
    {
        return $this->cities()->where('name', $cityName)->exists();
    }

    // Relation many-to-many avec Sector
    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'works', 'company_id', 'sector_id');
    }

    // Relation one-to-many avec Evaluation
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    // Relation one-to-many inverse avec City
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
