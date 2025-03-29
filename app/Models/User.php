<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\ClassModel; // Ensure this class exists in the specified namespace
use App\Models\RoleModel; // Ensure this class exists in the specified namespace

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
    
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'id_classes', 'id_classes');
    }

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'id_role', 'id_role');
    }
}
