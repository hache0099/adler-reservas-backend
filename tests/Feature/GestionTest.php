<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GestionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_modulos(): void
    {
        $response = $this->get('/api/v1/gestion/get-modulos');

        //dd($response->json());
        $response->assertStatus(200);
    }
}
