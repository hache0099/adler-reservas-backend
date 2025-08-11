<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReservaTest extends TestCase
{
    public function test_get_canchas(): void
    {
        $response = $this->get('/api/v1/reservas/get-canchas-disponibles?fecha=2025-04-22&hora=22');

        //dd($response->json());
        $response->assertStatus(200);
    }


    public function test_hora_imposible()
    {
        $response = $this->get('/api/v1/reservas/get-canchas-disponibles?fecha=2025-04-22&hora=05');

        //dd($response->json());
        $response->assertStatus(200);
    }

    public function test_reservas_hoy()
    {
        $response = $this->get('/api/v1/reservas/reservas-por-fecha');

        //dd($response->json());
        $response->assertStatus(200);
    }
}
