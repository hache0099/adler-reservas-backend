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
            'email' => 'palaciohector00@gmail.com',
            'password' => 'contraseña',
        ]);

        $response->assertStatus(200);
        
    }

    public function test_user_can_see_routes(): void
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'palaciohector00@gmail.com',
            'password' => 'contraseña',
        ]);

        $token = $response->json('token');


        $response = $this->withHeaders(['Authorization' => "Bearer {$token}"])->get('/api/v1/user');

        //dd($response->json());
        $response->assertJsonStructure(['id', 'email', 'email_verified_at', 'created_at', 'updated_at', 'persona_id', 'perfil_id']);
    }
}
