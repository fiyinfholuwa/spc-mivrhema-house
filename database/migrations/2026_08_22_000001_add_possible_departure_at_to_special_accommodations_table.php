<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('special_accommodations', 'possible_departure_at')) {
            Schema::table('special_accommodations', function (Blueprint $table) {
                $table->dateTime('possible_departure_at')->nullable()->after('phone');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('special_accommodations', 'possible_departure_at')) {
            Schema::table('special_accommodations', function (Blueprint $table) {
                $table->dropColumn('possible_departure_at');
            });
        }
    }
};
