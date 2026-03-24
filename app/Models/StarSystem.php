<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StarSystem extends Model
{
    protected $fillable = [
        'galaxy_id',
        'owner_player_id',
        'claim_player_id',
        'claim_progress',
        'claim_required_turns',
        'name',
        'x',
        'y',
        'z',
        'color_hex',
        'temperature',
        'base_scale',
        'threat_level',
    ];
    public function galaxy(): BelongsTo
    {
        return $this->belongsTo(Galaxy::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'owner_player_id');
    }

    public function planets(): HasMany
    {
        return $this->hasMany(Planet::class);
    }

    public function fleets(): HasMany
    {
        return $this->hasMany(Fleet::class, 'star_system_id');
    }

    public function hyperlanesFrom(): HasMany
    {
        return $this->hasMany(Hyperlane::class, 'from_star_system_id');
    }

    public function hyperlanesTo(): HasMany
    {
        return $this->hasMany(Hyperlane::class, 'to_star_system_id');
    }
}
