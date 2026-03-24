<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('planets', function (Blueprint $table) {
            $table->unsignedTinyInteger('size_slots')->default(10);
            $table->integer('population')->default(10);
            $table->float('happiness')->default(0.7);
            $table->string('specialization')->default('balanced');
            $table->boolean('is_capital')->default(false);
            $table->json('base_yields')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('planets', function (Blueprint $table) {
            $table->dropColumn(['size_slots','population','happiness','specialization','is_capital','base_yields']);
        });
    }
};
