<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_users';

    protected $fillable = [
        'name',
        'first_name',
        'birthdate',
        'email',
        'password',
        'pp',
        'id_classes',
        'id_role',
    ];

    protected $hidden = ['password'];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->name;
    }
}
