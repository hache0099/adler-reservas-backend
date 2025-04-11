<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/v1/user/1');

        //dd($response->json());
        $response->assertStatus(200);
        
    }


    public function try_noexistent_user(): void
    {
        $response = $this->get('/api/v1/user/6969');

        //dd($response->json());
        $response->assertStatus(400);
    }

    
}
