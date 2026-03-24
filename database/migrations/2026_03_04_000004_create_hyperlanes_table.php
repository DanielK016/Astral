<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hyperlanes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('galaxy_id')->constrained('galaxies')->cascadeOnDelete();
            $table->foreignId('from_star_system_id')->constrained('star_systems')->cascadeOnDelete();
            $table->foreignId('to_star_system_id')->constrained('star_systems')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['galaxy_id','from_star_system_id','to_star_system_id'], 'hyperlane_unique');
            $table->index(['galaxy_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hyperlanes');
    }
};
