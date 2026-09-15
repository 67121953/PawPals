<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Actor;

class Movie extends Model
{
    protected $table = 'movies';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'title',
        'release_year',
        'actor_id',
    ];

    public function actor(): BelongsTo
    {
        return $this->belongsTo(Actor::class, 'actor_id');
    }
}