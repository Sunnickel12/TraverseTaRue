<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
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
        'company_id',
        'sector_id',
    ];

    /**
     * Define the relationship with the Company model.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Define the relationship with the Sector model.
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}