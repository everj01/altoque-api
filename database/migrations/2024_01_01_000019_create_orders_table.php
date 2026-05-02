<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(\DB::raw('NEWID()'));

            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->unsignedBigInteger('branch_id')->nullable()->index();
            $table->integer('order_number')->nullable();
            $table->string('status', 20)->nullable();   // pending, preparing, ready, delivered, cancelled
            $table->string('order_type', 20)->nullable(); // dine_in, take_away, delivery
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->string('table_number', 8)->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->dateTime('created_at');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->boolean('is_active')->nullable();

            $table->unique(['tenant_id', 'branch_id', 'order_number']);
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};
