<?php

namespace App\Listeners;

use App\Services\RabbitMQService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class FetchSellerProductPrices
{
    /**
     * Create the event listener.
     */
    public function __construct(private RabbitMQService $rabbitMQ)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->rabbitMQ->publish(
            json_encode( [
                'message' => $event->productUrl,
            ] )
        );
    }
}
