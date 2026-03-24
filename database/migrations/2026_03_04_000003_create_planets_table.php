<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('star_system_id')->constrained('star_systems')->cascadeOnDelete();
            $table->string('name');
            $table->string('type')->default('rock'); // rock/desert/ocean/ice/gas
            $table->double('orbit_radius')->default(10.0);
            $table->double('radius')->default(1.0);
            $table->double('axial_tilt')->default(0.0);
            $table->double('rotation_speed')->default(0.01); // speed of axis rotation
            $table->boolean('has_rings')->default(false);
            $table->json('meta_json')->nullable();
            $table->timestamps();

            $table->index(['star_system_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planets');
    }
};
