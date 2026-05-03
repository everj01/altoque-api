<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('districts', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
        });

        Schema::table('provinces', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
        });

        Schema::rename('districts', 'ubigeo_districts');
        Schema::rename('provinces', 'ubigeo_provinces');
        Schema::rename('regions', 'ubigeo_regions');

        Schema::table('ubigeo_provinces', function (Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('ubigeo_regions');
        });

        Schema::table('ubigeo_districts', function (Blueprint $table) {
            $table->foreign('province_id')->references('id')->on('ubigeo_provinces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ubigeo_districts', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
        });

        Schema::table('ubigeo_provinces', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
        });

        Schema::rename('ubigeo_districts', 'districts');
        Schema::rename('ubigeo_provinces', 'provinces');
        Schema::rename('ubigeo_regions', 'regions');

        Schema::table('provinces', function (Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('regions');
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->foreign('province_id')->references('id')->on('provinces');
        });
    }
};
