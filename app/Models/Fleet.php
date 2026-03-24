<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fleet extends Model
{
    protected $fillable = [
        'player_id',
        'star_system_id',
        'planet_id',
        'name',
        'mission',
        'target_star_system_id',
        'mission_progress',
        'speed',
        'power'
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function system(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'star_system_id');
    }
    public function planet(): BelongsTo
    {
        return $this->belongsTo(Planet::class);
    }

    public function targetSystem(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'target_star_system_id');
    }
}
