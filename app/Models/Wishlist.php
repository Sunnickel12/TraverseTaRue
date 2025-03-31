<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists'; // Specify the table name

    protected $fillable = [
        'id_users',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_user');
    }
}