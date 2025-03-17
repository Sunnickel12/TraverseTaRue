<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Set the custom primary key
    protected $primaryKey = 'id_city';

    // Mass assignable fields
    protected $fillable = ['name'];

    // Relationship: A city has many offers
    public function offers()
    {
        return $this->hasMany(Offer::class, 'id_city', 'id_city');
    }
}
