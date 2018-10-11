<?php
require_once '../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('192.168.20.185', 5672, 'rabbit', '123456');
$channel = $connection->channel();

$channel->queue_declare('task_queue', false, true, false, false);
echo ' [*] 等待消息. 退出按 CTRL+C', "\n";

$callback = function($msg){
    echo " [x] 收到消息 ", $msg->body, "\n";
    sleep(substr_count($msg->body, '.'));
    echo " [x] 处理完毕", "\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

?>