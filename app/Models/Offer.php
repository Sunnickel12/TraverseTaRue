<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'contenu',
        'salary',
        'level',
        'start_date',
        'end_date',
        'duration',
        'city_id',
        'company_id',
    ];

    /**
     * Define the relationship with the City model.
     * An offer is associated with a specific city.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Define the relationship with the Company model.
     * An offer is associated with a specific company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * Define the many-to-many relationship with the User model.
     * An offer can be in the wishlist of multiple users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_wishlist', 'offer_id', 'id', 'user_id', 'id');
    }

    /**
     * Define the many-to-many relationship with the Wishlist model.
     * An offer can belong to multiple wishlists.
     */
    public function wishlists()
    {
        return $this->belongsToMany(Wishlist::class, 'belongs', 'offer_id', 'wishlist_id');
    }

    /**
     * Check if the offer is in the authenticated user's wishlist.
     */
    public function isInWishlist()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
        return $this->wishlists()->where('wishlist_id', $userId)->exists();
    }

    /**
     * Define the many-to-many relationship with the Sector model.
     * An offer can belong to multiple sectors.
     */
    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'defines', 'id_offer', 'id_sector');
    }

    /**
     * Define the many-to-many relationship with the Skill model.
     * An offer can require multiple skills.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'needs', 'offer_id', 'skill_id');
    }

    /**
     * Define the one-to-many relationship with the Postulation model.
     * An offer can have multiple postulations.
     */
    public function postulations()
    {
        return $this->hasMany(Postulation::class, 'offer_id', 'id');
    }
}
