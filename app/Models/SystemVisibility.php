<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemVisibility extends Model
{
    protected $table = 'system_visibility';
    protected $fillable = ['player_id','star_system_id','status','discovered_turn'];

    protected $casts = [
        'discovered_turn' => 'integer',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function system(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'star_system_id');
    }
}
