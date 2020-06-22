<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    /**
     * @test
     */
    public function cannotVisitWithoutLogin()
    {
        $response = $this->get('/admin/clients');
        $response->assertStatus(302);
        $response->assertLocation('/login');
    }

    /**
     * @test
     */
    public function canVisit()
    {
        $this->actingAs($this->admin);
        $response = $this->get('/admin/clients');
        $response->assertStatus(200);
    }




}
