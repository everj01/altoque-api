<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->string('invoice_number', 50)->nullable();
            $table->enum('status', ['pending', 'failed', 'success'])->default('pending');
            $table->decimal('total_amount', 13, 2)->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->text('payment_ref')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->dateTime('created_at');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->boolean('is_active')->default(true);

            $table->index('tenant_id');
            $table->index('subscription_id');

            $table->foreign('tenant_id')->references('id')->on('tenants')->nullOnDelete();
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
