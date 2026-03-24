<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_session_id','name','race_key','is_ai',
        'passives_json','active_key',

        'energy','minerals','science','rare_metals','exotic_gases','xenocultures',
        'energy_income','minerals_income','science_income','rare_metals_income','exotic_gases_income','xenocultures_income',

        'influence','unity','influence_income','unity_income',

        'current_research_key','research_progress',
        'home_star_system_id',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(GameSession::class, 'game_session_id');
    }

    public function fleets(): HasMany
    {
        return $this->hasMany(Fleet::class);
    }

    public function technologies(): HasMany
    {
        return $this->hasMany(PlayerTechnology::class);
    }

    public function passives(): array
    {
        $raw = $this->passives_json ?: '[]';
        $arr = json_decode($raw, true);
        return is_array($arr) ? $arr : [];
    }

    public function hasTech(string $key): bool
    {
        return $this->technologies()->where('tech_key', $key)->exists();
    }
}
