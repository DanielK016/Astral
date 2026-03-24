<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            $table->foreignId('star_system_id')->constrained('star_systems')->cascadeOnDelete();
            $table->string('name');
            $table->string('mission')->default('idle'); // idle/survey/move
            $table->foreignId('target_star_system_id')->nullable()->constrained('star_systems')->nullOnDelete();
            $table->unsignedTinyInteger('mission_progress')->default(0);
            $table->unsignedTinyInteger('speed')->default(1); // jumps per round
            $table->unsignedSmallInteger('power')->default(10); // combat power placeholder
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fleets');
    }
};
