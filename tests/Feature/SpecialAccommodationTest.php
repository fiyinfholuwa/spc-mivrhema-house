<?php

use App\Models\ConferenceRegistration;
use App\Models\SpecialAccommodation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function registration(array $attributes = []): ConferenceRegistration
{
    return ConferenceRegistration::create(array_merge([
        'fullname' => 'Test Guest',
        'gender' => 'female',
        'phone' => '08012345678',
        'email' => uniqid('guest').'@example.com',
        'how_heard' => 'friend',
        'previous_participation' => 'no',
        'registration_type' => 'individual',
        'expectations' => '',
        'commitment' => 'yes',
        'receive_updates' => 'yes',
    ], $attributes));
}

test('special accommodation register requires authentication', function () {
    $this->get(route('special-accommodations.index'))->assertRedirect(route('login'));
});

test('staff can enlist a confirmed registration and edit its populated details', function () {
    $user = User::factory()->create();
    $registration = registration([
        'fullname' => 'Ada Lovelace',
        'phone' => '+234 800 123 4567',
        'confirmed_reg' => 'confirmed',
    ]);

    $this->actingAs($user)->post(route('special-accommodations.store'), [
        'conference_registration_id' => $registration->id,
        'name' => $registration->fullname,
        'phone' => $registration->phone,
        'possible_departure_at' => '2026-08-24 14:30:00',
        'notes' => 'Ground-floor room',
    ])->assertRedirect();

    $entry = SpecialAccommodation::firstOrFail();
    expect($entry->created_by)->toBe($user->id);

    $this->actingAs($user)->patch(route('special-accommodations.update', $entry), [
        'conference_registration_id' => $registration->id,
        'name' => 'Ada L.',
        'phone' => '+234 800 765 4321',
        'possible_departure_at' => '2026-08-25 09:15:00',
        'notes' => 'Near the entrance',
    ])->assertRedirect();

    $this->assertDatabaseHas('special_accommodations', [
        'id' => $entry->id,
        'name' => 'Ada L.',
        'phone' => '+234 800 765 4321',
        'possible_departure_at' => '2026-08-25 09:15:00',
    ]);

    $this->actingAs($user)->delete(route('special-accommodations.destroy', $entry))->assertRedirect();
    $this->assertDatabaseMissing('special_accommodations', ['id' => $entry->id]);
});

test('only confirmed registrations can be selected', function () {
    $user = User::factory()->create();
    $pending = registration([
        'fullname' => 'Pending Guest',
        'phone' => '08012345678',
        'confirmed_reg' => 'pending',
    ]);

    $this->actingAs($user)->post(route('special-accommodations.store'), [
        'conference_registration_id' => $pending->id,
        'name' => $pending->fullname,
        'phone' => $pending->phone,
    ])->assertSessionHasErrors('conference_registration_id');

    $this->assertDatabaseCount('special_accommodations', 0);
});
