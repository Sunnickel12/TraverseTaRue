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
        'phone',
    ];

    /**
     * Define a relationship with the Evaluation model.
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    /**
     * Define a relationship with the City model.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Define a relationship with the Sector model.
     */
    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'works');
    }
}