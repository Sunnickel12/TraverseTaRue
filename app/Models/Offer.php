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
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Define the relationship with the Company model.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_wishlist', 'offer_id', 'id', 'user_id', 'id');
    }


    public function wishlists()
    {
        return $this->belongsToMany(Wishlist::class, 'belongs', 'offer_id', 'wishlist_id');
    }

    public function isInWishlist()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
        return $this->wishlists()->where('wishlist_id', $userId)->exists();
    }


    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'defines', 'id_offer', 'id_sector');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'needs', 'offer_id', 'skill_id');
    }

    public function postulations()
    {
        return $this->hasMany(Postulation::class, 'offer_id', 'id');
    }
}
