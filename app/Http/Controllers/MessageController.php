<?php

namespace App\Http\Controllers;

use App\Services\RabbitMQService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MessageController extends Controller {
    public function __construct( public RabbitMQService $rabbitMQService ) {
        $this->rabbitMQService->bindQueue( 'test-queue', 'default' );
    }

    public function send( Request $request ) {
        $this->rabbitMQService->publish(
            json_encode( [
                'message' => Str::random( 32),
            ] )
        );
    }
}
