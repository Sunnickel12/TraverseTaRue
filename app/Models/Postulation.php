<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;

    protected $table = 'postulation'; // Table concernée
    protected $primaryKey = 'id_postulation'; // Clé primaire

    protected $fillable = [
        'id_users',
        'id_offer',
        'cv',
        'motivation_letter',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'id_offers');
    }
}
