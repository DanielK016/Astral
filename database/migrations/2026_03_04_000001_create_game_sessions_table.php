<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('game_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('turn')->default(1);
            $table->string('difficulty')->default('normal');
            $table->string('galaxy_size')->default('medium');
            $table->unsignedTinyInteger('ai_count')->default(2);
            $table->string('state')->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_sessions');
    }
};
