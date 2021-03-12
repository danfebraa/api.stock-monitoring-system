<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionCollection;
use App\Models\Transaction;
use App\Models\Product;

use App\Events\ProductAttachedWebsocketEvent;

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TransactionCollection
     */
    public function index()
    {
        $transactions = Transaction::with(['client', 'supplier', 'products.productType'])->get();
        return new TransactionCollection($transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     * @return TransactionResource
     */
    public function store(TransactionRequest $request)
    {
        /*dd("C-".str_pad(100000, 5, 0, STR_PAD_LEFT));*/
        $validated = $request->validated();
        Log::info(json_encode($validated));
        $products = $request->Products;
        $valid = Arr::except($validated,['Products']);
        $valid['DocDate'] = Carbon::parse(Carbon::createFromDate($request['DocDate'])->format('Y-m-d'))->toDate();
        $valid['EntryDate'] = Carbon::parse(Carbon::createFromDate($request['EntryDate'])->format('Y-m-d'))->toDate();
        $toBeCreated = collect($valid)->transformKeys(fn ($key) => Str::snake($key))->toArray();

        $transaction = Transaction::create($toBeCreated);
        if($transaction->wasRecentlyCreated)
        {
            $grandTotal = 0;
            $exchangeRates = new ExchangeRate();
            foreach($products as $product)
            {
                $total = 0;
                $productLookUp = Product::find($product['Id']);
                switch ($transaction->action_type)
                {
                    case "Goods Receipt" : {
                        $total += $product['Quantity'] * $product['UnitPrice'];
                        $total = $exchangeRates->convert($total, 'USD', 'PHP', Carbon::now());
                        $grandTotal += $total;
                        $productLookUp->update(['quantity'=> $productLookUp->quantity + $product['Quantity']]);
                    }
                    case "Return to Warehouse" :
                    case "Positive Adjust" :
                        $total += $product['Quantity'] * $product['UnitPrice'];
                        $grandTotal += $total;
                        $productLookUp->update(['quantity'=> $productLookUp->quantity + $product['Quantity']]);
                        break;

                    case "Goods Issue":
                    case "Return to Supplier" :
                    case "Negative Adjust" :
                        $total += $product['Quantity'] * $product['UnitPrice'];
                        $grandTotal += $total;
                        $productLookUp->update(['quantity'=> $productLookUp->quantity - $product['Quantity']]);
                        break;
                }

                $transaction->products()->attach($productLookUp->id, [
                    'quantity' => $product['Quantity'],
                    'exchange_rate' => $exchangeRates->convert(1, 'USD', 'PHP', Carbon::now()),
                    'unit_price' => $product['UnitPrice'],
                    'total' => $total
                ]);
            }
            $transaction->update(['grand_total' => $grandTotal]);
            // After attaching all products to the transaction(rows are created), call the event to trigger a websocket,
            // so that all client users will get the update, that there's a new transaction.
            event(new ProductAttachedWebsocketEvent($transaction->loadMissing(['client', 'supplier','products.product_transaction', 'products.productType'])));
        }
        return new TransactionResource($transaction->loadMissing(['client', 'supplier','products']));
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return TransactionResource
     */
    public function show(Transaction $transaction)
    {
        $transaction = $transaction->loadMissing(['client', 'products.productType']);
        return new TransactionResource($transaction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function edit(Transaction $transaction)
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
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
