<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Transaction;
use App\Transactions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TransactionResource Collection
     */
    public function index()
    {
        return (TransactionResource::collection((Transaction::paginate(10))));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     * @return void
     */
    public function store(TransactionRequest $request)
    {

        $validated = $request->validated();
        $transaction= Transaction::create($validated);
        return response()->json(new TransactionResource($transaction), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function show(Transaction $transaction)
    {
        return response()->json(new TransactionResource($transaction), 201);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transactions
     * @return void
     */
    public function edit(Transaction $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $validated=$request->validated();
        $transaction->update($validated);
        return response()->json(new TransactionResource($transaction), 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return Response
     * @throws \Exception
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json('Deleted', 204);
    }
}
