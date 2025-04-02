<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
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
        return $this->belongsToMany(User::class, 'user_wishlist', 'offer_id', 'user_id');
    }
    public function postulations()
    {
        return $this->hasMany(Postulation::class, 'offer_id'); // 'offer_id' doit être la clé étrangère dans la table 'postulations'
    }


}

