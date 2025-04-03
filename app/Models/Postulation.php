<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;

    protected $table = 'postulations'; // Table concernée
    //protected $primaryKey = 'id_postulation'; // Clé primaire

    protected $fillable = [
        'user_id',
        'offer_id',
        'cv',
        'motivation_letter',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }
}
