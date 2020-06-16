<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientController extends TestCase
{
    /**
     * @test
     */
    public function canVisit()
    {
        $response = $this->get('/clients');

        $response->assertStatus(200);
    }
}
