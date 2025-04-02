<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'first_name',
        'birthdate',
        'email',
        'password',
        'pp',
        'classes_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->name;
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'id');
    }

    public function getRoleNameAttribute()
    {
        return $this->getRoleNames()->first(); // Get the first role name assigned to the user
    }
    public function wishlist()
    {
        return $this->belongsToMany(Offer::class, 'user_wishlist', 'user_id','offer_id');
    }

}
