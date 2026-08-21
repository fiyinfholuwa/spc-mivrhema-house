<?php

use App\Models\Room;
use App\Models\RoomMember;
use App\Models\User;

test('room member endpoints require authentication', function () {
    $room = Room::firstOrFail();

    $this->get(route('room-members.index', $room))->assertRedirect(route('login'));
    $this->post(route('room-members.store', $room), [])->assertRedirect(route('login'));
});

test('staff can add a member to a room', function () {
    $user = User::factory()->create();
    $room = Room::firstOrFail();

    $this->actingAs($user)->postJson(route('room-members.store', $room), [
        'name' => 'Ada Okafor',
        'phone' => '+234 801 234 5678',
    ])->assertCreated()->assertJson(['room_id' => $room->id]);

    $this->assertDatabaseHas('room_members', [
        'room_id' => $room->id,
        'name' => 'Ada Okafor',
        'phone' => '+234 801 234 5678',
        'recorded_by' => $user->id,
        'exited_at' => null,
    ]);
});

test('room member name and valid phone number are required', function () {
    $this->actingAs(User::factory()->create())
        ->postJson(route('room-members.store', Room::firstOrFail()), [
            'name' => '',
            'phone' => 'invalid phone',
        ])->assertUnprocessable()->assertJsonValidationErrors(['name', 'phone']);
});

test('marking a member exited retains their history and updates active counts', function () {
    $user = User::factory()->create();
    $room = Room::firstOrFail();
    $member = RoomMember::create([
        'room_id' => $room->id,
        'name' => 'Retained Member',
        'phone' => '08012345678',
        'checked_in_at' => now(),
        'recorded_by' => $user->id,
    ]);

    $this->actingAs($user)->patchJson(route('room-members.exit', $member))
        ->assertOk()->assertJson(['room_id' => $room->id]);

    expect(RoomMember::count())->toBe(1)
        ->and($member->refresh()->exited_at)->not->toBeNull()
        ->and($member->exited_by)->toBe($user->id)
        ->and($room->activeMembers()->count())->toBe(0);

    $this->getJson(route('room-members.index', $room))
        ->assertOk()
        ->assertJsonPath('active_count', 0)
        ->assertJsonPath('members.0.name', 'Retained Member')
        ->assertJsonPath('members.0.exited_by', $user->name);
});

test('room cards and top statistics show active room member counts', function () {
    $user = User::factory()->create();
    $room = Room::firstOrFail();
    foreach (['First Member', 'Second Member'] as $name) {
        RoomMember::create([
            'room_id' => $room->id,
            'name' => $name,
            'phone' => '08012345678',
            'checked_in_at' => now(),
            'recorded_by' => $user->id,
        ]);
    }

    $this->actingAs($user)->get(route('room-keys.index'))
        ->assertOk()
        ->assertSee('2 people in rooms')
        ->assertSee('Members: 2 inside');
});

test('staff can search across rooms by member name or room number', function () {
    $user = User::factory()->create();
    $room = Room::where('name', 'Room 12')->firstOrFail();
    RoomMember::create([
        'room_id' => $room->id,
        'name' => 'Searchable Ada',
        'phone' => '08012345678',
        'checked_in_at' => now(),
        'recorded_by' => $user->id,
    ]);

    $this->actingAs($user)->getJson(route('room-members.search', ['q' => 'Searchable']))
        ->assertOk()
        ->assertJsonPath('results.0.name', 'Searchable Ada')
        ->assertJsonPath('results.0.room_name', 'Room 12');

    $this->getJson(route('room-members.search', ['q' => '12']))
        ->assertOk()
        ->assertJsonFragment(['type' => 'room', 'room_name' => 'Room 12']);
});
