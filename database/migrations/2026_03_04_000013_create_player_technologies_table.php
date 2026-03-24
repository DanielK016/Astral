<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('player_technologies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            $table->string('tech_key');
            $table->timestamps();
            $table->unique(['player_id','tech_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_technologies');
    }
};
