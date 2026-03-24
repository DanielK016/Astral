<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planet extends Model
{
    protected $fillable = [
        'star_system_id',
        'name',
        'type',
        'orbit_radius',
        'radius',
        'axial_tilt',
        'rotation_speed',
        'has_rings',
        'meta_json',
        'size_slots',
        'population',
        'happiness',
        'specialization',
        'is_capital',
        'base_yields',
    ];

    protected $casts = [
        'base_yields' => 'array',
        'meta_json' => 'array',
        'has_rings' => 'boolean',
        'is_capital' => 'boolean',
    ];

    public function starSystem(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'star_system_id');
    }

    public function system(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'star_system_id');
    }

    public function buildings(): HasMany
    {
        return $this->hasMany(PlanetBuilding::class);
    }
}
