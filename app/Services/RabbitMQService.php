<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    protected $connection;
    protected $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', 'localhost'),
            env('RABBITMQ_PORT', 5672),
            env('RABBITMQ_USER', 'guest'),
            env('RABBITMQ_PASSWORD', 'guest')
        );

        $this->channel = $this->connection->channel();
    }

    public function publish($message, $routingKey = 'default')
    {
        if (false === json_validate($message)) {
            return false;
        }
        $msg = new AMQPMessage($message, ['content_type' => 'application/json']);
        $this->channel->basic_publish($msg, 'amq.direct', $routingKey);
    }

    public function bindQueue($queue, $routingKey)
    {
        $this->channel->queue_declare($queue, false, true, false, false);
        $this->channel->queue_bind($queue, 'amq.direct', $routingKey);
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
