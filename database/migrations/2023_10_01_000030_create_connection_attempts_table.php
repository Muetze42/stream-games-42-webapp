<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('connection_attempts', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->nullableMorphs('authenticatable', 'auth');
            $table->char('ip_hash', 32)->nullable();
            $table->string('uri')->nullable();
            $table->text('token')->nullable();
            $table->longText('data')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connection_attempts');
    }
};
