<?php
$config = require "./config.php";
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection($config['rabbitmq']['host'], $config['rabbitmq']['port'],
    $config['rabbitmq']['login'], $config['rabbitmq']['password'], $config['rabbitmq']['vhost']);
$channel = $connection->channel();

//发送方其实不需要设置队列， 不过对于持久化有关，建议执行该行
$channel->queue_declare('queue_one', false, false, false, false);

$msg = new AMQPMessage('游戏爱好者!荒野大镖客2发布');
$channel->basic_publish($msg, '', 'queue_one');

echo " [x] Sent Message ok\n";

$channel->close();
$connection->close();
?>