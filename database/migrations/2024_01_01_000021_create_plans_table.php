<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(\DB::raw('NEWID()'));

            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->longText('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('currency', 5)->nullable();
            $table->string('interval', 10)->nullable(); // monthly, yearly, daily, weekly
            $table->longText('features')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->dateTime('created_at');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->boolean('is_active')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('plans'); }
};
