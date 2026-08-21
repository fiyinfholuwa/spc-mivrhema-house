<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('room_key_logs', function (Blueprint $table) {
            $table->string('returner_name')->nullable()->after('returned_at');
            $table->string('returner_phone', 30)->nullable()->after('returner_name');
        });
    }

    public function down(): void
    {
        Schema::table('room_key_logs', function (Blueprint $table) {
            $table->dropColumn(['returner_name', 'returner_phone']);
        });
    }
};
