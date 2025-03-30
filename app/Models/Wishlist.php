<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'offer_id'];
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }
}
