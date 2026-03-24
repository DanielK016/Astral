<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'galaxy_id','current_player_id',
        'turn','difficulty','galaxy_size','ai_count','state','round_phase'
    ];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function galaxy(): BelongsTo
    {
        return $this->belongsTo(Galaxy::class);
    }

    public function currentPlayer(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'current_player_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(GameEvent::class);
    }
}
