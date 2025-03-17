<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    // The fills have to be reviewed
    protected $primaryKey = 'id_companie';
    
    protected $fillable = [
        'name', 'address', 'description', 'logo', 'phone', 'email'
    ];

    // Custom primary key
    
    

    // Primary key type and auto-increment setting
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Get the offers associated with the company.
     */
    public function offers()
    {
        return $this->hasMany(Offer::class, 'id_companie');
    }

    
    /**
     * Get the city the company is located in.
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'location', 'id_city');
    }
}