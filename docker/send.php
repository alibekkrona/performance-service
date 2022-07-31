<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('queue_service', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

$messageText = 'Hello World!!!!!!';
$msg = new AMQPMessage($messageText);
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent '$messageText'\n";

$channel->close();
$connection->close();

echo PHP_EOL;

