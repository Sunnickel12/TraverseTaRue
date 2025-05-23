<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'note',
        'comment',
        'user_id',
        'company_id',
    ];

    /**
     * Define the relationship with the User model.
     * An evaluation is written by a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with the Company model.
     * An evaluation is associated with a specific company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}