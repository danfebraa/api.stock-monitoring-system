<?php

namespace App\Jobs;

use App\Events\ProductAttachedWebsocketEvent;
use App\Models\Product;
use App\Models\Transaction;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StoreTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $validated;
    private $products;
    public function __construct(Request $request)
    {
        Log::info($request->validated());
        $this->validated = $request->validated();
        $this->products = $request->Products;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $validated = $this->validated;
        $products = $this->products;
        $valid = Arr::except($validated,['Products']);
        $valid['DocDate'] = Carbon::parse(Carbon::createFromDate($validated['DocDate'])->format('Y-m-d'))->toDate();
        $valid['EntryDate'] = Carbon::parse(Carbon::createFromDate($validated['EntryDate'])->format('Y-m-d'))->toDate();
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
                        break;
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
                    'exchange_rate' => ($transaction->action_type == "Goods Receipt")? $exchangeRates->convert(1, 'USD', 'PHP', Carbon::now()) : null,
                    'unit_price' => $product['UnitPrice'],
                    'total' => $total
                ]);
            }
            $transaction->update(['grand_total' => $grandTotal]);
            // After attaching all products to the transaction(rows are created), call the event to trigger a websocket,
            // so that all client users will get the update, that there's a new transaction.
            event(new ProductAttachedWebsocketEvent($transaction->loadMissing(['client', 'supplier','products.product_transaction', 'products.productType'])));
        }
    }
}
