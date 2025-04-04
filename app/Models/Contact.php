<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    // La table correspondante dans la base de données
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'content',
        'file',
        'status_id',
        'user_id',
    ];

    // Si tu veux activer la gestion automatique des timestamps
    public $timestamps = true;

    /**
     * Define the relationship with the Status model.
     * A contact has one status.
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * Define the relationship with the User model.
     * A contact is created by a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}