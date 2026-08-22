<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('special_accommodations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conference_registration_id')->nullable()->unique()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('phone', 30);
            $table->dateTime('possible_departure_at')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('special_accommodations');
    }
};
