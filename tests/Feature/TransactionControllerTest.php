<?php

namespace Tests\Feature\Api;

use App\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    /**
     * @test
     */
    public function cannotVisitWithoutLogin()
    {
        $response = $this->get('/admin/transactions');
        $response->assertStatus(302);
        $response->assertLocation('/login');
    }

    /**
     * @test
     */
    public function canVisit()
    {
        $this->actingAs($this->admin);
        $response = $this->get('/admin/transactions');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function canGetAllClients()
    {
        $this->actingAs($this->admin, 'api');
        $clients = factory(Client::class, 20)->create();
        $response = $this->get(route('clients.index'));
        $response->assertSuccessful();
        $responseData = $response->decodeResponseJson();
        $this->assertEquals(20, count($clients));

    }


}
