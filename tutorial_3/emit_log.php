<?php
require_once '../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('192.168.20.185', 5672, 'rabbit', '123456');
$channel = $connection->channel();
$channel->exchange_declare('logs', 'fanout', false, false, false);
$data = implode(' ', array_slice($argv, 1));
if (empty($data)) {
    $data = "好消息: 荒野大镖客2发布啦!";
}
$msg = new AMQPMessage($data);
$channel->basic_publish($msg, 'logs');
echo ' [x] 发送 ', $data, "\n";
$channel->close();
$connection->close();