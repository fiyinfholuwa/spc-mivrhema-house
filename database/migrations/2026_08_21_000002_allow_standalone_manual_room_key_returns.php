<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('room_key_logs', function (Blueprint $table) {
            $table->string('collector_name')->nullable()->change();
            $table->string('collector_phone', 30)->nullable()->change();
            $table->timestamp('collected_at')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('room_key_logs', function (Blueprint $table) {
            $table->string('collector_name')->nullable(false)->change();
            $table->string('collector_phone', 30)->nullable(false)->change();
            $table->timestamp('collected_at')->nullable(false)->change();
        });
    }
};
