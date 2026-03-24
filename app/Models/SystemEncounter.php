<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemEncounter extends Model
{
    protected $fillable = [
        'game_session_id',
        'player_id',
        'star_system_id',
        'enemy_player_id',
        'enemy_ship_type',
        'status',
        'turns_remaining',
        'outcome',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(GameSession::class, 'game_session_id');
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function enemyPlayer(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'enemy_player_id');
    }

    public function system(): BelongsTo
    {
        return $this->belongsTo(StarSystem::class, 'star_system_id');
    }

    public function isResolved(): bool
    {
        return $this->status === 'resolved';
    }
}
