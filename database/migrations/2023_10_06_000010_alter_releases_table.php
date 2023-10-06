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
        Schema::table('releases', function (Blueprint $table) {
            $table->json('file_hashes')->nullable()->after('download_url');
            $table->json('virus_total_stats')->nullable()->after('download_url');
            $table->string('virus_total_id')->nullable()->after('download_url');
            $table->string('body')->nullable()->after('release_id');
            $table->string('name')->nullable()->after('release_id');
            $table->boolean('active')->default(false)->after('prerelease');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('releases', function (Blueprint $table) {
            $table->dropColumn([
               'name',
               'body',
               'file_hashes',
               'virus_total_id',
               'virus_total_stats',
               'active',
            ]);
        });
    }
};
