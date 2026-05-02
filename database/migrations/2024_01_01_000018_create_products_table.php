<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(\DB::raw('NEWID()'));

            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('name', 200)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->boolean('is_available')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->dateTime('created_at');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->boolean('is_active')->nullable();

            $table->unique(['tenant_id', 'branch_id', 'name']);
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
        });
    }
    public function down(): void { Schema::dropIfExists('products'); }
};
