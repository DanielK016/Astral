<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanetBuilding extends Model
{
    protected $fillable = ['planet_id','player_id','slot_index','building_key'];

    public function planet(): BelongsTo
    {
        return $this->belongsTo(Planet::class);
    }


    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
