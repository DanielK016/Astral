<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('system_encounters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_session_id')->constrained('game_sessions')->cascadeOnDelete();
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            $table->foreignId('star_system_id')->constrained('star_systems')->cascadeOnDelete();
            $table->foreignId('enemy_player_id')->constrained('players')->cascadeOnDelete();
            $table->string('enemy_ship_type', 32)->default('medium');
            $table->string('status', 32)->default('contact');
            $table->unsignedTinyInteger('turns_remaining')->nullable();
            $table->string('outcome', 32)->nullable();
            $table->timestamps();

            $table->index(['game_session_id', 'player_id', 'star_system_id'], 'se_session_player_system_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_encounters');
    }
};
