<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Actor extends Model
{
    protected $table = 'actor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'gender',
        'address',
        'cost',
        'image',
        'belong',
    ];

    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class);
    }
}