<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('diplomatic_relations', function (Blueprint $table) {
            $table->integer('score')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('diplomatic_relations', function (Blueprint $table) {
            $table->dropColumn('score');
        });
    }
};
