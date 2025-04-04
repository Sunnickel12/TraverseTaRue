<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'offer_id',
    ];

    /**
     * Define the relationship with the User model.
     * A wishlist belongs to a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the many-to-many relationship with the Offer model.
     * A wishlist can contain multiple offers.
     */
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'belongs', 'wishlist_id', 'offer_id');
    }
}

