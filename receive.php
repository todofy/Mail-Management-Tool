<?php

$SECURE = true;

include __DIR__ .'/libs/database.php';

database::Start();

require_once '/JSON/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('mail', 'direct', false, false, false);

list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

//update database with queue name
$result = database::SQL("INSERT INTO `queue`(`name`) VALUES(?)",array('s',$queue_name));
$result = database::SQL("SELECT `id` FROM `queue` WHERE `name`=? LIMIT 1",array('s',$queue_name));
if(empty($result)){
	$channel->close();
	$connection->close();
	exit;
}
$queue_id = $result[0]['id'];

$channel->queue_bind($queue_name, 'mail', 'API');

echo ' [*] Waiting for mails. To exit press CTRL+C', "\n";

$callback = function($message){
  echo ' [x] ',$message->delivery_info['routing_key'], ':', $message->body, "\n";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

//Remove queue from database
$result = database::SQL("DELETE FROM `queue` WHERE `id`=?",array('i',$queue_id));

$channel->close();
$connection->close();

exit;

?>