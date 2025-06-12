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
        Schema::create('conference_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('rating_overall');
            $table->string('spiritual_impact');
            $table->text('highlight_sessions')->nullable();
            $table->string('content_quality');
            $table->string('speaker_rating');
            $table->string('logistics')->nullable();
            $table->string('venue_rating')->nullable();
            $table->string('attend_again');
            $table->text('improvements')->nullable();
            $table->text('testimonies')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference_feedback');
    }
};
