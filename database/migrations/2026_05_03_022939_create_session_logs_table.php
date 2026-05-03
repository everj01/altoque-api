<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('session_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique()->default(DB::raw('NEWID()'));
            $table->unsignedBigInteger('user_id');
            $table->enum('action', ['login', 'logout']);
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('device')->nullable();      // Desktop, Mobile, Tablet
            $table->string('platform')->nullable();    // Windows, Android, iOS
            $table->string('browser')->nullable();     // Chrome, Firefox, etc.
            $table->boolean('is_mobile')->default(false);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'action']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('session_logs');
    }
};
