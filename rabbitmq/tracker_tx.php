<?php

/**
 * tracker file that checks if any mail id from campaign id is missing
 */
// all the sdk includes
$SECURE = true;

include __DIR__ .'/../libs/session.php';
include __DIR__ .'/../libs/api.php';
include __DIR__ .'/../libs/user.php';
require_once __DIR__ .'/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

//declare queue
$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('mailing_queue', false, true, false, false);

echo ' [*] Tracker for unsent mail ids is on. To exit press CTRL+C';

while(true){
	//get campaigns whose payload is remaining
	$result = database::SQL("SELECT `id`,`payload_sent`,`payload_length` FROM `campaign` WHERE `payload_length`!=`payload_sent`");
	foreach ($result as $value) {
		//get the base mail id for the campaign
		$mail_ids = database::SQL("SELECT `id` FROM `mail` WHERE `campaign_id`=? LIMIT 1",array('s',$value['id']));
		$counter = 0;
		foreach ($mail_ids as $MID) {
			if($counter < $value['payload_sent'])
				$counter++;
			else{
				$mail_id = $MID['id'];
				$message = new AMQPMessage($mail_id);
				$channel->basic_publish($message, '', 'mailing_queue');
			}
		}
	}
}

$channel->close();
$connection->close();

?>