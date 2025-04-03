<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    // La table correspondante dans la base de données
    protected $table = 'contact';

    // Attributs assignables (les champs que tu autorises à être remplis)
    protected $fillable = [
        'title',
        'content',
        'file',
        'status_id',
        'user_id',
    ];
    
    // Si tu veux activer la gestion automatique des timestamps
    public $timestamps = true;

    // Relier le modèle Contact avec la table Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    // Relier le modèle Contact avec la table User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}