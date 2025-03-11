<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;



class ClassModel extends Model
{
    protected $table = 'classes'; // Ensure it's the correct table name

    public function users()
    {
        return $this->hasMany(User::class, 'id_classes');
    }
}
