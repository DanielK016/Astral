<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('system_visibility', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            $table->foreignId('star_system_id')->constrained('star_systems')->cascadeOnDelete();
            $table->string('status')->default('unknown');
            $table->timestamps();
            $table->unique(['player_id','star_system_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_visibility');
    }
};
