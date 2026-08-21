<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('key_label')->unique();
            $table->boolean('is_overflow')->default(false);
            $table->timestamps();
        });

        Schema::create('room_key_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->string('collector_name');
            $table->string('collector_phone', 30);
            $table->text('checkout_note')->nullable();
            $table->timestamp('collected_at');
            $table->foreignId('checked_out_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('returned_at')->nullable();
            $table->foreignId('returned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('return_note')->nullable();
            $table->timestamps();
            $table->index(['room_id', 'returned_at']);
        });

        $now = now();
        $rooms = [];
        for ($number = 1; $number <= 25; $number++) {
            $rooms[] = ['name' => "Room {$number}", 'key_label' => "KEY-{$number}", 'is_overflow' => false, 'created_at' => $now, 'updated_at' => $now];
        }
        $rooms[] = ['name' => 'Overflow', 'key_label' => 'KEY-OVERFLOW', 'is_overflow' => true, 'created_at' => $now, 'updated_at' => $now];
        DB::table('rooms')->insert($rooms);
    }

    public function down(): void
    {
        Schema::dropIfExists('room_key_logs');
        Schema::dropIfExists('rooms');
    }
};
