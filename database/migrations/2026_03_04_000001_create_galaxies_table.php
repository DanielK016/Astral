<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('galaxies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Новая галактика');
            $table->unsignedBigInteger('seed')->nullable();
            $table->unsignedInteger('size')->default(300); // кол-во систем
            $table->unsignedTinyInteger('arms')->default(4);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galaxies');
    }
};
