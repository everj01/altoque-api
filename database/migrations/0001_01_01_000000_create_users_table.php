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
       Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique()->nullable();
            
            $table->string('firstname', 250);
            $table->string('lastname', 250);
            $table->string('phone', 20)->unique()->nullable();
            $table->string('email', 300)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            
            $table->boolean('mfa_enabled')->default(false);
            $table->string('timezone')->nullable();
            
            $table->bigInteger('created_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->softDeletesTz();
            
            $table->boolean('is_active')->default(true);
            
            $table->index('email');
            $table->index('phone');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
