<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;

    protected $table = 'postulations'; // Table concernée
    protected $primaryKey = 'id_postulations'; // Clé primaire

    protected $fillable = [
        'id_users',
        'id_offers',
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
