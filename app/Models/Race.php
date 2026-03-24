<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Race extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color_hex',
        'traits_json',
        'home_star_system_id',
    ];

    protected $casts = [
        'traits_json' => 'array',
    ];

    public function homeStarSystem(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'home_star_system_id');
    }
}
