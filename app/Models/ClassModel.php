<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes'; // Ensure this matches your database table name
    protected $primaryKey = 'id'; // Ensure this matches your table's primary key

    protected $fillable = [
        'name',
        'description',
    ];
}