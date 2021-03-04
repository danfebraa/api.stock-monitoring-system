<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Str;

class ProductUpdatedWebsocketEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    private $product;
    public function __construct(Product $_product)
    {
        $this->product = $_product;
    }

    public function broadcastWith()
    {

        $product = new ProductResource($this->product);
        return collect($product)->toArray();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
     {
         return new Channel('product-channel');
     }
     public function broadcastAs()
    {
        return 'product-updated-websocket-event';
    }
}
