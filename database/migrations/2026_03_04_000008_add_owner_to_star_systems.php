<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('star_systems', function (Blueprint $table) {
            $table->foreignId('owner_player_id')->nullable()->after('galaxy_id')->constrained('players')->nullOnDelete();
            $table->unsignedTinyInteger('threat_level')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('star_systems', function (Blueprint $table) {
            $table->dropConstrainedForeignId('owner_player_id');
            $table->dropColumn('threat_level');
        });
    }
};
