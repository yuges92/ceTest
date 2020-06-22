<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreClient;
use App\Http\Requests\UpdateClient;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        factory(Client::class,100)->create();
        return (new ClientCollection((Client::paginate(10))));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param StoreClient $request
     * @return void
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClient $request
     * @return Client $client
     */
    public function store(StoreClient $request)
    {
        $validated = $request->validated();
        $client= Client::create($validated);
        if ($request->file('avatar')) {
            $filename = $client->id . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->storeAs('public',$filename);
            $client->avatar = $filename;
            $client->update();
        }

        return response()->json($client, 201);


    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Client $client)
    {
        return response()->json(new ClientResource($client), 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClient $request
     * @param Client $client
     * @return void
     */
    public function update(UpdateClient $request, Client $client)
    {
        $validated = $request->validated();
        $client->update($validated);
        if ($request->file('avatar')) {
            $filename = $client->id . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->storeAs('public',$filename);
            $client->avatar = $filename;
        }

        return response()->json($client, 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        Storage::delete('public/'.$client->avatar);
        $client->delete();
        return response()->json('Deleted', 204);
    }


}
