<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Define the many-to-many relationship with the Offer model.
     * A skill can be required by multiple offers.
     */
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'needs', 'skill_id', 'offer_id')->withTimestamps();
    }
}