<?php

namespace Tests\Feature\Api;

use App\Client;
use App\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
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
    public function canGetAllTransactions()
    {
        $this->actingAs($this->admin, 'api');
        $transactions = factory(Transaction::class, 20)->create();
        $response = $this->get(route('transactions.index'));
        $response->assertSuccessful();
        $responseData = $response->decodeResponseJson();
        $response->assertJsonStructure([
            "data",
            "links",
            "meta"
        ]);
        $response->assertJsonCount(10,'data' );
        $this->assertEquals(20, Transaction::all()->count());

    }


    /**
     * @test
     */
    public function canGetATransaction()
    {
        $this->actingAs($this->admin, 'api');
        $transaction = factory(Transaction::class)->create();
        $response = $this->getJson(route('transactions.show', $transaction->id));
        $response->assertSuccessful();
        $responseData = $response->decodeResponseJson();
        $this->assertEquals($transaction->id, $responseData['id']);
        $this->assertEquals($transaction->client_id, $responseData['client_id']);
        $this->assertEquals($transaction->transactionDate, $responseData['transactionDate']);
        $this->assertEquals($transaction->amount, $responseData['amount']);

    }

    /**
     * @test
     */
    public function canCreateATransaction()
    {
        $this->actingAs($this->admin, 'api');
        $data = factory(Transaction::class)->make()->toArray();
        $response = $this->postJson(route('transactions.store'), $data);
        $response->assertSuccessful();
        $this->assertDatabaseHas('transactions', $data);

    }


    /**
     * @test
     */
    public function canUpdateATransaction()
    {
        $this->actingAs($this->admin, 'api');
        $transaction = factory(Transaction::class)->create();
        $client = factory(Client::class)->create();
        $data = [
            'client_id' => $client->id,
            'transactionDate' => "2020-04-10",
            'amount' => '22.50',
        ];
        $response = $this->putJson(route('transactions.update', $transaction->id), $data);
        $response->assertSuccessful();
        $this->assertDatabaseHas('transactions', $data);

    }

    /**
     * @test
     */
    public function canDeleteATransaction()
    {
        $this->actingAs($this->admin, 'api');
        $transaction = factory(Transaction::class)->create();
        $response = $this->deleteJson(route('transactions.destroy', $transaction->id));
        $response->assertSuccessful();
        $this->assertDatabaseMissing('transactions', $transaction->toArray());

    }

}
