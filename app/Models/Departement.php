<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departements'; 

    public $timestamps = true; 

    protected $fillable = [
        'name',
        'region_id', 
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id'); 
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'departement_id');
    }
}
