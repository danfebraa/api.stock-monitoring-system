<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionCollection;
use App\Models\Transaction;
use App\Models\Product;

use App\Events\ProductAttachedWebsocketEvent;

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
        $transactions = Transaction::with(['client', 'products.productType'])->get();
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
        /*dd("C-".str_pad(100000, 5, 0, STR_PAD_LEFT));*/
        $validated = $request->validated();
        Log::info(json_encode($validated));
        $products = $request->Products;
        $valid = Arr::except($validated,['Products']);
        $toBeCreated = collect($valid)->transformKeys(fn ($key) => Str::snake($key))->toArray();

        $transaction = Transaction::create($toBeCreated);
        if($transaction->wasRecentlyCreated)
        {
            $grandTotal = 0;
            foreach($products as $product)
            {
                $total = 0;
                $productLookUp = Product::find($product['Id']);
                switch ($transaction->action_type)
                {
                    case "Return to Warehouse" :
                    case "Goods Receipt" :
                    case "Positive Adjust" :
                        $productLookUp->update(['quantity'=> $productLookUp->quantity + $product['Quantity']]);
                        break;

                    case "Goods Issue":
                    case "Return to Supplier" :
                    case "Negative Adjust" :
                        $productLookUp->update(['quantity'=> $productLookUp->quantity - $product['Quantity']]);
                        break;
                }
                $total += $productLookUp->price* $product['Quantity'];
                $grandTotal += $total;
                $transaction->products()->attach($productLookUp->id, [
                    'quantity' => $product['Quantity'],
                    'priced_at' => $productLookUp->price,
                    'total' => $total
                ]);
            }
            $transaction->update(['grand_total' => $grandTotal]);
            // After attaching all products to the transaction(rows are created), call the event to trigger a websocket,
            // so that all client users will get the update, that there's a new transaction.
            event(new ProductAttachedWebsocketEvent($transaction->loadMissing(['client','products.product_transaction', 'products.productType'])));
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
        $transaction = $transaction->loadMissing(['client', 'products.productType']);
        return new TransactionResource($transaction);
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
