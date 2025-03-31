<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers'; 
    protected $primaryKey = 'id_offers';

    protected $fillable = [
        'id_offers', 
        'title', 
        'contenu', 
        'salary', 
        'niveau',    
        'duree',        
        'publication_date' 
    ];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id_companies');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_wishlist', 'offer_id', 'id_offers', 'user_id', 'id_users');
    }


    public $timestamps = false; // Désactiver les timestamps si ta table n'a pas created_at / updated_at
}
