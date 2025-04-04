<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The User model represents a user in the application.
 * It includes attributes, relationships, and accessors for user-related data.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * Accessor to get the full name of the user.
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->name;
    }

    /**
     * Define the relationship with the ClassModel.
     * A user belongs to a specific class.
     */
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'classes_id');
    }

    /**
     * Accessor to get the first role name assigned to the user.
     */
    public function getRoleNameAttribute()
    {
        return $this->getRoleNames()->first();
    }

    /**
     * Define the relationship with the Wishlist model.
     * A user can have one wishlist.
     */
    public function wishlist()
    {
        return $this->hasOne(Wishlist::class);
    }

    /**
     * Define the relationship with the Postulation model.
     * A user can have multiple postulations.
     */
    public function postulations()
    {
        return $this->hasMany(Postulation::class);
    }
}
