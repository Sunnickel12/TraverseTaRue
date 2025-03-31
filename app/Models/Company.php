<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    //protected $primaryKey = 'id'; 

    protected $fillable = [
        'id', 
        'name', 
        'city', 
        'address', 
        'description', 
        'logo'
    ];
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    public $timestamps = false; 
}