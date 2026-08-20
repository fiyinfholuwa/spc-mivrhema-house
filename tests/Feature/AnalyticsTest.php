<?php

use App\Models\ConferenceRegistration;
use App\Models\User;

test('analytics only includes confirmed attendees', function () {
    $registration = [
        'email' => null,
        'location' => 'Lagos',
        'state' => 'Lagos',
        'previous_participation' => 'No',
        'registration_type' => 'individual',
        'source_type' => 'miv',
        'expectations' => '',
        'commitment' => 'Yes',
        'receive_updates' => 'yes',
    ];

    ConferenceRegistration::create([
        ...$registration,
        'fullname' => 'Confirmed Attendee',
        'gender' => 'female',
        'phone' => '08011111111',
        'how_heard' => 'Friend',
        'mode_of_participation' => 'physical',
        'marital_status' => 'single',
        'confirmed_reg' => 'confirmed',
    ]);

    ConferenceRegistration::create([
        ...$registration,
        'fullname' => 'Pending Attendee',
        'gender' => 'male',
        'phone' => '08022222222',
        'how_heard' => 'Social media',
        'mode_of_participation' => 'virtual',
        'marital_status' => 'married',
        'confirmed_reg' => 'pending',
    ]);

    ConferenceRegistration::create([
        ...$registration,
        'fullname' => 'Virtual Confirmed Attendee',
        'gender' => 'male',
        'phone' => '08033333333',
        'email' => 'virtual@example.com',
        'how_heard' => 'Friend',
        'mode_of_participation' => 'virtual',
        'marital_status' => 'single',
        'confirmed_reg' => 'confirmed',
    ]);

    $response = $this->actingAs(User::factory()->create())->get('/analytics');

    $response
        ->assertOk()
        ->assertViewHas('registrationTotal', 3)
        ->assertViewHas('confirmedTotal', 2)
        ->assertViewHas('confirmedVirtualAttendees', function ($attendees) {
            return $attendees->count() === 1
                && $attendees->first()->email === 'virtual@example.com';
        })
        ->assertViewHas('analytics', function (array $analytics) {
            return $analytics['gender'] === ['Female' => 1, 'Male' => 1]
                && $analytics['participation'] === ['Virtual' => 1, 'Physical' => 1]
                && $analytics['how_heard'] === ['Friend' => 2]
                && $analytics['marital_status'] === ['Single' => 2];
        });
});
