<?php

/**
 * tracker file that checks if any mail is yet to be sent
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

echo ' [*] Tracker for unprocessed mail ids is on. To exit press CTRL+C';

while(true){
	$result = database::SQL("SELECT `id`,`payload_sent`,`mails_processed` FROM `campaign`");
	for($i = 0; $i < count($result); $i++){
		//check if all mails in the campaign are sent or not
		$campaign_id = $result[$i]['id'];
		$payload_sent = $result[$i]['payload_sent'];
		$mails_processed = $result[$i]['mails_processed'];
		if($mails_processed == $payload_sent){
			//update the time_finished for the campaign
			$time_finished = time();
			$result = database::SQL("UPDATE `campaign` SET `time_finished`=? WHERE `id`=?",array('is',$time_finished,$campaign_id));
		}
		else{
			//get the mails that are not yet processed
			$result = database::SQL("SELECT `id` FROM `mail` WHERE `campaign_id`=? AND `status`=0",array('s',$campaign_id));
			for ($i=0; $i < count($result); $i++) { 
				//push the unprocessed mail ids to queue
				$mail_id = $result[$i]['id'];
				$message = new AMQPMessage($mail_id);
				$channel->basic_publish($message, '', 'mailing_queue');
			}
		}
	}
}

$channel->close();
$connection->close();

?>