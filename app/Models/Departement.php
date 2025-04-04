<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departements';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'region_id',
    ];

    /**
     * Define the relationship with the Region model.
     * A department belongs to a specific region.
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * Define the relationship with the City model.
     * A department can have multiple cities.
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'departement_id');
    }
}
