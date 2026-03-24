<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_session_id')->constrained('game_sessions')->cascadeOnDelete();
            $table->string('name');
            $table->string('race_key');
            $table->boolean('is_ai')->default(false);

            $table->text('passives_json')->nullable();
            $table->string('active_key')->nullable();

            $table->integer('energy')->default(100);
            $table->integer('minerals')->default(100);
            $table->integer('science')->default(0);
            $table->integer('rare_metals')->default(0);
            $table->integer('exotic_gases')->default(0);
            $table->integer('xenocultures')->default(0);

            $table->integer('energy_income')->default(10);
            $table->integer('minerals_income')->default(10);
            $table->integer('science_income')->default(5);
            $table->integer('rare_metals_income')->default(0);
            $table->integer('exotic_gases_income')->default(0);
            $table->integer('xenocultures_income')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('players');
    }
};
