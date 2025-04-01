<?php
<<<<<<< HEAD

=======
>>>>>>> origin/feature_CRUD_users
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes';
=======

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes'; // Ensure this matches your database table name
    protected $primaryKey = 'id'; // Ensure this matches your table's primary key

    protected $fillable = [
        'name',
        'description',
    ];
>>>>>>> origin/feature_CRUD_users
}