<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

it('logs in with correct credentials', function () {
    
// Create a user with known credentials
    $password = 'password';
    $user = User::factory()->create([
        'first_name' => 'Unit',
        'last_name' => 'Test',
        'email' => 'test@example.com',
        'password' => Hash::make($password),
    ]);

    // Send POST request to the login route with the correct credentials
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    // Assert that the user is authenticated and redirected to the home page
    $this->assertAuthenticatedAs($user);
    $response->assertRedirect('/dashboard');
});