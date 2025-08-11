<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChangePassword extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_change_password(): void
    {
        $response = $this->get('api/v1/user/password', [
            'id' => 1,
            'currentPassword' => 'Todosputos',
            'newPassword' => 'admin123'
        ]);

        dd($response->json());
        
        $response->assertStatus(400);
    }
}
