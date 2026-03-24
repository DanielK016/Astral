<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiplomaticRelation extends Model
{
    protected $fillable = ['game_session_id','a_player_id','b_player_id','status','score'];

    public function session(): BelongsTo { return $this->belongsTo(GameSession::class, 'game_session_id'); }
    public function a(): BelongsTo { return $this->belongsTo(Player::class, 'a_player_id'); }
    public function b(): BelongsTo { return $this->belongsTo(Player::class, 'b_player_id'); }

    public static function key(int $a, int $b): array
    {
        return ($a < $b) ? [$a,$b] : [$b,$a];
    }
}
