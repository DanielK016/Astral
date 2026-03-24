<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('star_systems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('galaxy_id')->constrained('galaxies')->cascadeOnDelete();
            $table->string('name');
            $table->double('x');
            $table->double('y');
            $table->double('z');
            $table->string('color_hex', 12)->default('#ffdd99');
            $table->unsignedInteger('temperature')->default(5800);
            $table->double('base_scale')->default(1.0);
            $table->timestamps();

            $table->index(['galaxy_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('star_systems');
    }
};
