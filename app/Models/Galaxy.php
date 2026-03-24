<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Galaxy extends Model
{
    protected $fillable = ['name','seed','size','arms','notes'];

    public function systems(): HasMany
    {
        return $this->hasMany(StarSystem::class);
    }

    public function hyperlanes(): HasMany
    {
        return $this->hasMany(Hyperlane::class);
    }
}
