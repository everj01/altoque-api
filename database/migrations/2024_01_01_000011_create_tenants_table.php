<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(\DB::raw('NEWID()'));

            $table->string('company_name')->unique();
            $table->string('slug')->unique();
            $table->longText('logo_url')->nullable();
            $table->string('primary_color', 7)->nullable();
            $table->string('timezone', 10)->nullable();
            $table->string('language', 5)->nullable();
            $table->string('tax_id', 50)->unique()->nullable();
            $table->string('email', 300)->nullable();
            $table->string('phone', 20)->nullable();
            $table->longText('address')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->dateTime('created_at');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->boolean('is_active')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('tenants'); }
};
