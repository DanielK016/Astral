<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('planet_buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planet_id')->constrained('planets')->cascadeOnDelete();
            $table->unsignedTinyInteger('slot_index');
            $table->string('building_key');
            $table->timestamps();
            $table->unique(['planet_id','slot_index']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planet_buildings');
    }
};
