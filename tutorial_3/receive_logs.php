<?php
require_once '../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
$connection = new AMQPStreamConnection('192.168.20.185', 5672, 'rabbit', '123456');
$channel = $connection->channel();
$channel->exchange_declare('logs', 'fanout', false, false, false);
list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);
$channel->queue_bind($queue_name, 'logs');
echo ' [*] 等待消息. 退出按 CTRL+C', "\n";
$callback = function ($msg) {
    echo ' [x] ', $msg->body, "\n";
};
$channel->basic_consume($queue_name, '', false, true, false, false, $callback);
while (count($channel->callbacks)) {
    $channel->wait();
}
$channel->close();
$connection->close();