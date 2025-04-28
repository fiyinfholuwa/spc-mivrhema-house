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
        Schema::create('conference_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('gender');
            $table->string('phone');
            $table->string('email');
            $table->string('location')->nullable();
            $table->string('how_heard');
            $table->string('previous_participation');
            $table->string('registration_type');
            $table->string('source_type')->default('miv');
            $table->string('group_name')->nullable();
            $table->integer('group_size')->nullable();
            $table->text('expectations');
            $table->string('commitment');
            $table->string('receive_updates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference_registrations');
    }
};
