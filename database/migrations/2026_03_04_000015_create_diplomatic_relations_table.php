<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('diplomatic_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_session_id')->constrained('game_sessions')->cascadeOnDelete();
            $table->foreignId('a_player_id')->constrained('players')->cascadeOnDelete();
            $table->foreignId('b_player_id')->constrained('players')->cascadeOnDelete();
            $table->string('status')->default('unknown');
            $table->timestamps();
            $table->unique(['game_session_id','a_player_id','b_player_id'], 'dr_sess_a_b_uq');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diplomatic_relations');
    }
};
