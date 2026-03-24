<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('star_systems', function (Blueprint $table) {
            $table->foreignId('claim_player_id')->nullable()->after('owner_player_id')->constrained('players')->nullOnDelete();
            $table->unsignedTinyInteger('claim_progress')->default(0)->after('claim_player_id');
            $table->unsignedTinyInteger('claim_required_turns')->default(5)->after('claim_progress');
        });
    }

    public function down(): void
    {
        Schema::table('star_systems', function (Blueprint $table) {
            $table->dropConstrainedForeignId('claim_player_id');
            $table->dropColumn(['claim_progress', 'claim_required_turns']);
        });
    }
};