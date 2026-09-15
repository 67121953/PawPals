<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pet;

class Adoption extends Model
{
    protected $fillable = [
    'pet_id',
    'name',
    'phone',
    'email',
    'address',
    'occupation',
    'experience',
    'reason',
    'status',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}