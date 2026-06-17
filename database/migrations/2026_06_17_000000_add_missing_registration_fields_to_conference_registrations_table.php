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
            if (! Schema::hasColumn('conference_registrations', 'state')) {
                $table->string('state')->nullable();
            }

            if (! Schema::hasColumn('conference_registrations', 'mode_of_participation')) {
                $table->string('mode_of_participation')->nullable();
            }

            if (! Schema::hasColumn('conference_registrations', 'marital_status')) {
                $table->string('marital_status')->nullable();
            }

            if (! Schema::hasColumn('conference_registrations', 'coming_with_spouse')) {
                $table->string('coming_with_spouse')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conference_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('conference_registrations', 'coming_with_spouse')) {
                $table->dropColumn('coming_with_spouse');
            }

            if (Schema::hasColumn('conference_registrations', 'marital_status')) {
                $table->dropColumn('marital_status');
            }

            if (Schema::hasColumn('conference_registrations', 'mode_of_participation')) {
                $table->dropColumn('mode_of_participation');
            }

            if (Schema::hasColumn('conference_registrations', 'state')) {
                $table->dropColumn('state');
            }
        });
    }
};
