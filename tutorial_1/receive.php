<?php
$config = require "../config.php";
require_once '../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection($config['rabbitmq']['host'], $config['rabbitmq']['port'],
    $config['rabbitmq']['login'], $config['rabbitmq']['password'], $config['rabbitmq']['vhost']);
$channel = $connection->channel();

$channel->queue_declare('queue_one', false, false, false, false);

echo ' [*] 等待消息. 退出按 CTRL+C', "\n";

$callback = function($msg) {
    echo " [x] 收到消息 ", $msg->body, "\n";
};

$channel->basic_consume('queue_one', '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>