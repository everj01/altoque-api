<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->binary('uuid', 16)->unique()->nullable();

            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->unsignedBigInteger('subscription_id')->nullable()->index();
            $table->string('invoice_number', 50)->nullable();
            $table->string('status', 10)->nullable(); // pending, failed, success
            $table->decimal('total_amount', 13, 2)->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->nvarchar('payment_ref', 'max')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->nvarchar('notes', 'max')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->dateTime('created_at');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->boolean('is_active')->nullable();

            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
