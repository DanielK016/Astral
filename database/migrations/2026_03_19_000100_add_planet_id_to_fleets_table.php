<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('fleets', function (Blueprint $table) {
            $table->foreignId('planet_id')
                ->nullable()
                ->after('star_system_id')
                ->constrained('planets')
                ->nullOnDelete();
        });

        $fleets = DB::table('fleets')->select('id', 'star_system_id')->get();

        foreach ($fleets as $fleet) {
            $planetId = DB::table('planets')
                ->where('star_system_id', $fleet->star_system_id)
                ->orderByDesc('is_capital')
                ->orderBy('orbit_radius')
                ->value('id');

            if ($planetId) {
                DB::table('fleets')
                    ->where('id', $fleet->id)
                    ->update(['planet_id' => $planetId]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('fleets', function (Blueprint $table) {
            $table->dropConstrainedForeignId('planet_id');
        });
    }
};