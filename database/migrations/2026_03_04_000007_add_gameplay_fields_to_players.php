<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->integer('influence')->default(0);
            $table->integer('unity')->default(0);
            $table->integer('influence_income')->default(0);
            $table->integer('unity_income')->default(0);

            $table->string('current_research_key')->nullable();
            $table->integer('research_progress')->default(0);

            $table->foreignId('home_star_system_id')->nullable()->constrained('star_systems')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropConstrainedForeignId('home_star_system_id');
            $table->dropColumn([
                'influence','unity','influence_income','unity_income',
                'current_research_key','research_progress'
            ]);
        });
    }
};
