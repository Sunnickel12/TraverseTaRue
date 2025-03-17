<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $primaryKey = 'id_region';

    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Get the cities in the region.
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'id_region');
    }
}