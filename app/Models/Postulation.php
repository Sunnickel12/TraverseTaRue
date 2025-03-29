<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;

    protected $table = 'postulations';
    protected $primaryKey = 'id_postulation';
    public $timestamps = false;

    protected $fillable = ['cv', 'motivation_letter', 'status', 'id_users', 'id_offer', 'create_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'id_offer', 'id_offer');
    }
}
