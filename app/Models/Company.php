<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'description', 'logo', 'location', 'contact_email'];

    // Set custom primary key
    protected $primaryKey = 'id_companie';

    // Ensure the primary key is not auto-incrementing if it's not an integer
    public $incrementing = true;

    // Set the primary key type if needed (e.g., 'string' if UUIDs are used)
    protected $keyType = 'int';
}
