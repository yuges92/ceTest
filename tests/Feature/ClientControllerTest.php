<?php

namespace Tests\Feature\Api;

use App\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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


    /**
     * @test
     */
    public function canGetAllClients()
    {
        $this->actingAs($this->admin, 'api');
        $clients = factory(Client::class, 20)->create();
        $response = $this->get(route('clients.index'));
        $response->assertStatus(201);
        $responseData = $response->decodeResponseJson();
        $this->assertEquals(20, count($clients));

    }

    /**
     * @test
     */
    public function canGetAClient()
    {
        $this->actingAs($this->admin, 'api');
        $client = factory(Client::class)->create();
        $response = $this->getJson(route('clients.show', $client->id));
        $response->assertStatus(201);
        $responseData = $response->decodeResponseJson();
        $this->assertEquals($client->id, $responseData['id']);
        $this->assertEquals($client->firstName, $responseData['firstName']);
        $this->assertEquals($client->lastName, $responseData['lastName']);
        $this->assertEquals($client->avatar, $responseData['avatar']);
        $this->assertEquals($client->email, $responseData['email']);

    }


    /**
     * @test
     */
    public function canCreateAClient()
    {
        Storage::fake('local');
        $this->actingAs($this->admin, 'api');
        $avatar = UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(100);
        $data = [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'avatar' => $avatar,
            'email' => $this->faker->unique()->safeEmail
        ];
        $response = $this->postJson(route('clients.store'), $data);
        $responseData = $response->decodeResponseJson();
        $response->assertSuccessful();
        $data = Arr::except($data, ['avatar']);
        $this->assertDatabaseHas('clients', $data);
        Storage::disk('local')->assertExists('public/'.$responseData['avatar']);
        Storage::delete('public/'.$responseData['avatar']);
        Storage::disk('local')->assertMissing('public/'.$responseData['avatar']);

    }

    /**
     * @test
     */
    public function canUpdateAClient()
    {
        Storage::fake('local');
        $this->actingAs($this->admin, 'api');
        $client = factory(Client::class)->create();

        $avatar = UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(100);
        $data = [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'avatar' => $avatar,
            'email' => $this->faker->unique()->safeEmail
        ];
        $response = $this->putJson(route('clients.update', $client->id), $data);
        $response->assertSuccessful();
        $data = Arr::except($data, ['avatar']);
        $this->assertDatabaseHas('clients', $data);
        Storage::disk('local')->assertMissing('public/'.$client->avatar);

    }


    /**
     * @test
     */
    public function canDeleteAClient()
    {
        Storage::fake('local');
        $this->actingAs($this->admin, 'api');
        $client = factory(Client::class)->create();

        $this->assertDatabaseHas('clients', [
            'firstName' => $client->firstName,
            'lastName' => $client->lastName,
            'email' => $client->email
        ]);
        $response = $this->deleteJson(route('clients.destroy', $client->id));
        $response->assertSuccessful();
        $this->assertDatabaseMissing('clients', [
            'firstName' => $client->firstName,
            'lastName' => $client->lastName,
            'email' => $client->email
        ]);

    }



}
