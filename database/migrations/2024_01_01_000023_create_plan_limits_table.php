<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('plan_limits', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(\DB::raw('NEWID()'));

            $table->unsignedBigInteger('plan_id')->nullable()->index();
            $table->string('feature_name', 50)->nullable();
            $table->integer('limit_value')->nullable();
            $table->string('category_value', 20)->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->dateTime('created_at');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->boolean('is_active')->nullable();

            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }
    public function down(): void { Schema::dropIfExists('plan_limits'); }
};
