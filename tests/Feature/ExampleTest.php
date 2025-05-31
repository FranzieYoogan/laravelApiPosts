<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
{
    $response = $this->postJson('/register', [
        'name' => 'Sally',
        'email' => 'sally' . uniqid() . '@example.com', // email único
        'password' => '12345678',
        'password_confirmation' => '12345678',
    ]);

    $response->assertStatus(200);
}
}
