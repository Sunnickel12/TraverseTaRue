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
        'id',
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
        return $this->belongsToMany(User::class, 'belongs', 'offer_id', 'user_id');
    }

    public function wishlists()
{
    return $this->belongsToMany(Wishlist::class, 'belongs', 'offer_id', 'wishlist_id');
}

    public function isInWishlist()
    {
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        return $this->wishlists()->where('user_id', $user->id)->exists();

    }
}

