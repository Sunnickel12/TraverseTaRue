<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'description', 'logo', 'email', 'phone'
    ];

    public function cities()
    {
        return $this->belongsToMany(City::class, 'situates', 'company_id', 'city_id');
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'works', 'company_id', 'sector_id');
    }
}
