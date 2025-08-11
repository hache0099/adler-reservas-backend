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
            'password' => 'Todosputos',
        ]);
        //dd($response->json());
        $response->assertStatus(200);
        
    }

    public function test_user_can_see_routes(): void
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'palaciohector00@gmail.com',
            'password' => 'Todosputos',
        ]);

        $token = $response->json('token');


        $response = $this->withHeaders(['Authorization' => "Bearer {$token}"])->get('/api/v1/user');

        //dd($response->json());
        //$response->assertJsonStructure(['id', 'email', 'email_verified_at', 'created_at', 'updated_at', 'persona_id', 'perfil_id']);
        $response->assertStatus(200);
    }

    public function user_can_logout(): void
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'palaciohector00@gmail.com',
            'password' => 'Todosputos',
        ]);
        $token = $response->json('token');

        $response = $this->withHeaders(['Authorization' => "Bearer {$token}"])->get('/api/v1/auth/logout');

        $response->assertStatus(200);
    }

    public function test_change_password(): void
    {
        $response = $this->put('api/v1/change-password', [
            'id' => '1',
            'currentPassword' => 'Todosputos',
            'newPassword' => 'admin123'
        ]);

        //dd($response->json());
        
        $response->assertStatus(400);
    }

    public function test_check_email_exists() : void
    {
        $response = $this->put('api/v1/change-password', [
            'id' => '1',
            'currentPassword' => 'Todosputos',
            'newPassword' => 'admin123'
        ]);
    }
}
