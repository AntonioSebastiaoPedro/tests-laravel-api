<?php

use App\Models\User;

use function Pest\Laravel\postJson;

it('should auth user', function () {
    $user = User::factory()->create();
    $data = [
        'email' => $user->email,
        'password' => 'password',
        'device_name' => 'Samsung',
    ];
    postJson(route('auth.login'), $data)
        ->assertOk()
        ->assertJsonStructure(['token']);
});
