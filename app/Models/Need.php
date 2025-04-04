<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'offer_id',
        'skill_id',
    ];

    /**
     * Define the relationship with the Offer model.
     * A need entry belongs to a specific offer.
     */
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    /**
     * Define the relationship with the Skill model.
     * A need entry belongs to a specific skill.
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}