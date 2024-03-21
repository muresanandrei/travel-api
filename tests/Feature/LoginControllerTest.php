<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('logs in a user and returns a token', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(['success', 'token'])
        ->assertJson(['success' => true]);

    $this->assertNotNull($response->json('token'));
});

it('fails to log in with invalid credentials', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'nonexistent@example.com',
        'password' => 'invalidpassword',
    ]);

    $response->assertStatus(Response::HTTP_UNAUTHORIZED)
        ->assertJsonStructure(['success', 'message'])
        ->assertJson(['success' => false]);
});

it('returns error if there is an issue during login process', function () {
    // This test mocks a scenario where an unexpected error occurs during login
    // You might want to adapt this based on your specific error handling logic
    Sanctum::actingAs(User::factory()->create());

    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
});
