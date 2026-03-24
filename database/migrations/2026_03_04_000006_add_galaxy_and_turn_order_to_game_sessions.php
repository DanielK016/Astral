<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('game_sessions', function (Blueprint $table) {
            $table->foreignId('galaxy_id')->nullable()->after('id')->constrained('galaxies')->nullOnDelete();
            $table->foreignId('current_player_id')->nullable()->after('galaxy_id')->constrained('players')->nullOnDelete();
            $table->unsignedTinyInteger('round_phase')->default(0)->after('turn'); // 0 = normal
        });
    }

    public function down(): void
    {
        Schema::table('game_sessions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('current_player_id');
            $table->dropConstrainedForeignId('galaxy_id');
            $table->dropColumn('round_phase');
        });
    }
};
