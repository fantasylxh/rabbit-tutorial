<?php
return [
    'vendor' => [
        'path' => dirname(dirname(__DIR__)) . '/vendor'
    ],
    'rabbitmq' => [
        'host' => '192.168.20.185',
        'port' => '5672',
        'login' => 'rabbit',
        'password' => '123456',
        'vhost' => '/'
    ]
];
?>