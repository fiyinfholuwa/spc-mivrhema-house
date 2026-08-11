<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('conference_registrations', 'confirmed_reg')) {
            Schema::table('conference_registrations', function (Blueprint $table) {
                $table->string('confirmed_reg')->nullable()->default('pending')->after('receive_updates');
            });
        }

        if (! Schema::hasColumn('conference_registrations', 'bible_group')) {
            Schema::table('conference_registrations', function (Blueprint $table) {
                $table->unsignedTinyInteger('bible_group')->nullable()->after('confirmed_reg');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('conference_registrations', 'bible_group')) {
            Schema::table('conference_registrations', function (Blueprint $table) {
                $table->dropColumn('bible_group');
            });
        }

        if (Schema::hasColumn('conference_registrations', 'confirmed_reg')) {
            Schema::table('conference_registrations', function (Blueprint $table) {
                $table->dropColumn('confirmed_reg');
            });
        }
    }
};
