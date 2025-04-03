<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'name',
        'first_name',
        'birthdate',
        'email',
        'password',
        'pp',
        'classes_id',
    ];

    protected $dates = ['deleted_at'];

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
        return $this->belongsTo(ClassModel::class, 'classes_id');
    }

    public function getRoleNameAttribute()
    {
        return $this->getRoleNames()->first(); // Get the first role name assigned to the user
    }

    public function wishlist()
    {
        return $this->hasOne(Wishlist::class);
    }

    public function postulations()
    {
        return $this->hasMany(Postulation::class);
    }
    
}
