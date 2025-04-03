<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;

    protected $table = 'postulations'; // Table concernée
    //protected $primaryKey = 'id_postulation'; // Clé primaire

    
    protected $dates = ['deleted_at']; // Enable soft delete timestamps

    protected $fillable = [
        'user_id',
        'offer_id',
        'cv',
        'motivation_letter',
        'status_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }
}
