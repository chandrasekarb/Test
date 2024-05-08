<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful login.
     */
    public function test_successful_login(): void
    {
        // Create a user to test with
        $user = \App\Models\User::factory(\App\User::class)->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        // Attempt to login with correct credentials
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Assert the response status and message
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Login successful']);
    }

    /**
     * Test login with incorrect credentials.
     */
    public function test_login_with_incorrect_credentials(): void
    {
        // Create a user to test with
        $user = \App\Models\User::factory(\App\User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        // Attempt to login with incorrect credentials
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        // Assert the response status and message
        $response->assertStatus(401);
        $response->assertJson(['message' => 'Invalid credentials']);
    }

    /**
     * Test logout.
     */
    public function test_logout(): void
    {
        // Create a user to test with
        $user = \App\Models\User::factory(\App\User::class)->create();

        // Login the user
        Auth::login($user);

        // Logout the user
        $response = $this->post('/logout');

        // Assert the response status and message
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Logged out']);
    }
}