<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'salary', 'location', 'company_id'];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
