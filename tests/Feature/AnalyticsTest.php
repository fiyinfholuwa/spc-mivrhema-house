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

    $response = $this->actingAs(User::factory()->create())->get('/analytics');

    $response
        ->assertOk()
        ->assertViewHas('total', 1)
        ->assertViewHas('analytics', function (array $analytics) {
            return $analytics['gender'] === ['Female' => 1]
                && $analytics['participation'] === ['Virtual' => 0, 'Physical' => 1]
                && $analytics['how_heard'] === ['Friend' => 1]
                && $analytics['marital_status'] === ['Single' => 1];
        });
});
