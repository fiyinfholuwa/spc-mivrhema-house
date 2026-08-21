<?php

use App\Models\Room;
use App\Models\RoomKeyLog;
use App\Models\User;

test('room key register requires authentication', function () {
    $this->get(route('room-keys.index'))->assertRedirect(route('login'));
});

test('migration creates twenty five rooms and an overflow', function () {
    expect(Room::count())->toBe(26)
        ->and(Room::where('is_overflow', true)->value('name'))->toBe('Overflow');
});

test('staff can record a key collection with contact details', function () {
    $user = User::factory()->create();
    $room = Room::firstOrFail();

    $this->actingAs($user)->post(route('room-keys.checkout', $room), [
        'collector_name' => 'Ada Okafor',
        'collector_phone' => '+234 801 234 5678',
        'checkout_note' => 'Group leader',
    ])->assertRedirect()->assertSessionHas('status');

    $this->assertDatabaseHas('room_key_logs', [
        'room_id' => $room->id,
        'collector_name' => 'Ada Okafor',
        'collector_phone' => '+234 801 234 5678',
        'checked_out_by' => $user->id,
        'returned_at' => null,
    ]);
});

test('a room key cannot be checked out to two people at once', function () {
    $user = User::factory()->create();
    $room = Room::firstOrFail();
    RoomKeyLog::create([
        'room_id' => $room->id,
        'collector_name' => 'First Collector',
        'collector_phone' => '08011111111',
        'collected_at' => now(),
        'checked_out_by' => $user->id,
    ]);

    $this->actingAs($user)->post(route('room-keys.checkout', $room), [
        'collector_name' => 'Second Collector',
        'collector_phone' => '08022222222',
    ])->assertSessionHasErrors('room');

    expect($room->keyLogs()->count())->toBe(1);
});

test('staff can return a key and the audit history is retained', function () {
    $checkoutUser = User::factory()->create();
    $returnUser = User::factory()->create();
    $room = Room::firstOrFail();
    $log = RoomKeyLog::create([
        'room_id' => $room->id,
        'collector_name' => 'Ada Okafor',
        'collector_phone' => '08012345678',
        'collected_at' => now(),
        'checked_out_by' => $checkoutUser->id,
    ]);

    $this->actingAs($returnUser)->patch(route('room-keys.return', $log), [
        'return_note' => 'Returned in good condition',
        'same_returner' => true,
    ])->assertRedirect()->assertSessionHas('status');

    $log->refresh();
    expect($log->returned_at)->not->toBeNull()
        ->and($log->returned_by)->toBe($returnUser->id)
        ->and($log->return_note)->toBe('Returned in good condition')
        ->and(RoomKeyLog::count())->toBe(1);

    $this->get(route('room-keys.history', $room))
        ->assertOk()
        ->assertSee('Ada Okafor')
        ->assertSee('Returned in good condition');
});

test('collector name and a valid phone number are required', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('room-keys.checkout', Room::firstOrFail()), [
            'collector_name' => '',
            'collector_phone' => 'not a phone',
        ])->assertSessionHasErrors(['collector_name', 'collector_phone']);
});

test('ajax collection and audit requests return json', function () {
    $user = User::factory()->create();
    $room = Room::firstOrFail();

    $this->actingAs($user)->postJson(route('room-keys.checkout', $room), [
        'collector_name' => 'Ajax Collector',
        'collector_phone' => '08012345678',
    ])->assertOk()->assertJson(['room_id' => $room->id]);

    $this->getJson(route('room-keys.history', $room))
        ->assertOk()
        ->assertJsonPath('room.name', $room->name)
        ->assertJsonPath('logs.data.0.collector_name', 'Ajax Collector');
});

test('a room supports multiple completed collection and return cycles', function () {
    $user = User::factory()->create();
    $room = Room::firstOrFail();

    foreach (['First Collector', 'Second Collector'] as $collector) {
        $this->actingAs($user)->postJson(route('room-keys.checkout', $room), [
            'collector_name' => $collector,
            'collector_phone' => '08012345678',
        ])->assertOk();

        $log = $room->keyLogs()->whereNull('returned_at')->firstOrFail();
        $this->patchJson(route('room-keys.return', $log), ['return_note' => 'Returned', 'same_returner' => true])->assertOk();
    }

    expect($room->keyLogs()->count())->toBe(2)
        ->and($room->keyLogs()->whereNull('returned_at')->count())->toBe(0);
});

test('staff can enter a collection and return from the manual register', function () {
    $user = User::factory()->create();
    $room = Room::firstOrFail();

    $this->actingAs($user)->postJson(route('room-keys.checkout', $room), [
        'activity_type' => 'completed',
        'collector_name' => 'Manual Collector',
        'collector_phone' => '08012345678',
        'collected_at' => now()->subHours(3)->format('Y-m-d H:i:s'),
        'returned_at' => now()->subHours(2)->format('Y-m-d H:i:s'),
        'return_note' => 'Copied from paper register',
        'same_returner' => true,
    ])->assertOk();

    $log = $room->keyLogs()->firstOrFail();
    expect($log->returned_at)->not->toBeNull()
        ->and($log->returned_by)->toBe($user->id)
        ->and($room->fresh()->activeKeyLog)->toBeNull();
});

test('staff can record a different person returning the key', function () {
    $user = User::factory()->create();
    $room = Room::firstOrFail();
    $log = RoomKeyLog::create([
        'room_id' => $room->id,
        'collector_name' => 'Original Collector',
        'collector_phone' => '08011111111',
        'collected_at' => now(),
        'checked_out_by' => $user->id,
    ]);

    $this->actingAs($user)->patchJson(route('room-keys.return', $log), [
        'returner_name' => 'Different Returner',
        'returner_phone' => '08022222222',
    ])->assertOk();

    expect($log->refresh()->returner_name)->toBe('Different Returner')
        ->and($log->returner_phone)->toBe('08022222222');
});
