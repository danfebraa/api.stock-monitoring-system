<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


use App\Models\Transaction;
use App\Http\Resources\TransactionResource;

class ProductAttachedWebsocketEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $transaction;
    /**
     * Create a new event instance.
     * ProductAttachedWebsocketEvent
     *
     * ProductAttachedWebsocketEvent
     * @return void
     */
    public function __construct(Transaction $_transaction)
    {
        $this->transaction = $_transaction;
    }

    public function broadcastWith()
    {
        $transactionResource = new TransactionResource($this->transaction);
        return collect($transactionResource)->toArray();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
     public function broadcastOn()
     {
         return new Channel('product-transaction-channel');
     }

    public function broadcastAs()
    {
        return 'product-attached-websocket-event';
    }
}
