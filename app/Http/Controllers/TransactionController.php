<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionCollection;
use App\Models\Transaction;
use App\Models\Product;

use App\Events\ProductTransactionCreatedWebsocketEvent;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with(['client', 'products'])->get();
        return new TransactionCollection($transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return TransactionRescource
     */
    public function store(TransactionRequest $request)
    {
        $validated = $request->validated();
        Log::info(json_encode($validated));
        $products = $request->Products;
        $valid = Arr::except($validated,['Products']);
        $toBeCreated = collect($valid)->transformKeys(fn ($key) => Str::snake($key))->toArray();

        $transaction = Transaction::create($toBeCreated);
        if($transaction->wasRecentlyCreated)
        {
            foreach($products as $product) 
            {
                $productLookUp = Product::find($product['Id']);
                switch ($transaction->action_type)
                {
                    case "NewArrival" :
                        $productLookUp->update(['quantity'=> $productLookUp->quantity + $product['Quantity']]);
                        break;
                    case "Delivery" :
                        $productLookUp->update(['quantity'=> $productLookUp->quantity - $product['Quantity']]);
                        break;
                }

                $transaction->products()->attach($productLookUp->id,['quantity' => $product['Quantity']]);
            }
            // After attaching all products to the transaction(rows are created), call the event to trigger a websocket,
            // so that all client users will get the update, that there's a new transaction.
            event(new ProductTransactionCreatedWebsocketEvent($transaction->loadMissing('client','products')));
        }
        return new TransactionResource($transaction->loadMissing(['client','products']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
