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
        Schema::table('conference_registrations', function (Blueprint $table) {
            if (! Schema::hasColumn('conference_registrations', 'accommodation_preference')) {
                $table->string('accommodation_preference')->nullable()->after('mode_of_participation');
            }
        });
    }

    public function down(): void
    {
        Schema::table('conference_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('conference_registrations', 'accommodation_preference')) {
                $table->dropColumn('accommodation_preference');
            }
        });
    }
};
