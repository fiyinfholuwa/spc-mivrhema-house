<?php

test('a conference registration can be submitted without an email address', function () {
    $response = $this->postJson('/register-conference', [
        'fullname' => 'Test Attendee',
        'gender' => 'female',
        'phone' => '08012345678',
        'location' => 'Lagos',
        'state' => 'Lagos',
        'how_heard' => 'Friend',
        'previous_participation' => 'No',
        'mode_of_participation' => 'physical',
        'registration_type' => 'individual',
        'marital_status' => 'single',
        'commitment' => 'Yes',
        'receive_updates' => 'yes',
    ]);

    $response
        ->assertOk()
        ->assertJsonPath('status', 'success');

    $this->assertDatabaseHas('conference_registrations', [
        'fullname' => 'Test Attendee',
        'email' => null,
    ]);
});

test('registrations without email addresses are stored separately', function () {
    $registration = [
        'gender' => 'male',
        'phone' => '08012345678',
        'location' => 'Lagos',
        'state' => 'Lagos',
        'how_heard' => 'Friend',
        'previous_participation' => 'No',
        'mode_of_participation' => 'physical',
        'registration_type' => 'individual',
        'marital_status' => 'single',
        'commitment' => 'Yes',
        'receive_updates' => 'yes',
    ];

    $this->postJson('/register-conference', ['fullname' => 'First Attendee', ...$registration])
        ->assertOk();
    $this->postJson('/register-conference', ['fullname' => 'Second Attendee', ...$registration])
        ->assertOk();

    $this->assertDatabaseCount('conference_registrations', 2);
});
