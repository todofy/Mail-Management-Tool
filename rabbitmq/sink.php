<?php
$SECURE = true;

include __DIR__ .'/../libs/session.php';
include __DIR__ .'/../libs/globals.php';
include __DIR__ .'/../libs/user.php';
include __DIR__ .'/../libs/database.php';
require_once __DIR__ .'/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

database::Start();

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->exchange_declare('worker_ack', 'fanout', false, false, false);
$channel->exchange_declare('sink_ack', 'fanout', false, false, false);

$campaign_id = $argv[1];

list($queue_sink, ,) = $channel->queue_declare("", false, false, true, false);
$channel->queue_bind($queue_sink, 'sink_ack');

$callback = function($message){
	if($message->body == $campaign_id){
		$result = database::SQL("SELECT `payload_sent`,`mails_processed` FROM `campaign` WHERE `campaign_id`=? LIMIT 1",array('s',$campaign_id));
		if($result[0]['payload_sent'] == $result[0]['mails_processed']){
			//send acknowledgement back to vent
			$c_id = new AMQPMessage($campaign_id);
			$channel->basic_publish($c_id, 'sink_ack');
			$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);	
			exit;
		}
	}
	$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);	
};

$channel->basic_consume($queue_sink, '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

exit;
?>
