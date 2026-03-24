<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hyperlane extends Model
{
    protected $fillable = [
        'galaxy_id',
        'from_star_system_id',
        'to_star_system_id',
    ];

    public function galaxy(): BelongsTo
    {
        return $this->belongsTo(Galaxy::class);
    }

    public function fromStarSystem(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'from_star_system_id');
    }

    public function toStarSystem(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'to_star_system_id');
    }


    public function fromSystem(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'from_star_system_id');
    }

    public function toSystem(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'to_star_system_id');
    }
}
