<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Support\Facade\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'test2@example.com',
            'password' => 'Contraseña',
        ]);

        $response->assertStatus(200);
        
    }

    public function test_user_can_see_routes(): void
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'test2@example.com',
            'password' => 'Contraseña',
        ]);

        $token = $response->json('token');


        $response = $this->withHeaders(['Authorization' => "Bearer {$token}"])->get('/api/v1/user');

        dd($response->json());
    }
}
