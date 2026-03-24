<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('planet_buildings', function (Blueprint $table) {
            if (!Schema::hasColumn('planet_buildings', 'player_id')) {
                $table->foreignId('player_id')->nullable()->after('planet_id')->constrained('players')->nullOnDelete();
            }
        });

        Schema::table('system_visibility', function (Blueprint $table) {
            if (!Schema::hasColumn('system_visibility', 'discovered_turn')) {
                $table->unsignedInteger('discovered_turn')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('planet_buildings', function (Blueprint $table) {
            if (Schema::hasColumn('planet_buildings', 'player_id')) {
                $table->dropConstrainedForeignId('player_id');
            }
        });

        Schema::table('system_visibility', function (Blueprint $table) {
            if (Schema::hasColumn('system_visibility', 'discovered_turn')) {
                $table->dropColumn('discovered_turn');
            }
        });
    }
};
