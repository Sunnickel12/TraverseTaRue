<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
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

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'defines', 'id_sector', 'id_offer')->withTimestamps();
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'works', 'sector_id', 'company_id');
    }
}
