<?php
$SECURE = true;

include __DIR__ .'/libs/database.php';
include __DIR__ .'/libs/api.php';

database::Start();

require_once '/JSON/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('mail', 'direct', false, false, false);

list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

$channel->queue_bind($queue_name, 'mail', 'API');

echo ' [*] Waiting for mail ids. To exit press CTRL+C', "\n";

//function to generate actual mail and send
$callback = function($message){
	$mail_id = $message->body;
	echo "\n";
	echo $mail_id.' received.';
	//update the time_started for this mail
	$time_started = time();
	$result = database::SQL("UPDATE `mail` SET `time_started`=? WHERE `id`=?",array('ii',$time_started,$mail_id));

	//get campaign id, hence api_code

	$result = database::SQL("SELECT `campaign_id` FROM `mail` WHERE `id`=? LIMIT 1",array('i',$mail_id));
	$campaign_id = $result[0]['campaign_id'];

	$result = database::SQL("SELECT `api_code` FROM `campaign` WHERE `id`=? LIMIT 1",array('s',$campaign_id));
	$api_code = $result[0]['api_code'];

	//get the values of api parameters
	$result = database::SQL("SELECT `payload` FROM `mail` WHERE `id`=? LIMIT 1",array('i',$mail_id));
	$payload = $result[0]['payload'];
	$parameters = json_decode($payload,true);

	//get the sender and subject from database
	$result = database::SQL("SELECT `sender`,`subject` FROM `campaign` WHERE `id`=? LIMIT 1",array('s',$campaign_id));
	$from = $result[0]['sender'];
	$subject = $result[0]['subject'];



	$api = new api($api_code,$parameters,$mail_id);
	$api->validate_call();
	if($api->state == false){
		echo $api->err;
		exit;
		//report wrong api_code and discard
	}
	else
	{
		$mail = $api->replace_params_links();
		$to = $api->send_to();
		echo "\n";
		echo $mail;

		//send mail
		//mail($to,$subject,$mail,$from);
		sleep(2);
		//update database
		$time_finished = time();
		$result = database::SQL("UPDATE `mail` SET `time_finished`=?,`sent`=1 WHERE `id`=?",array('ii',$time_finished,$mail_id));
		$result = database::SQL("UPDATE `campaign` SET `payload_sent`=`payload_sent`+1 WHERE `id`=?",array('s',$campaign_id));
		//check if all entries in payload processed or not
		$result = database::SQL("SELECT `payload_length`,`payload_sent` FROM `campaign` WHERE `id`=? LIMIT 1",array('s',$campaign_id));
		$payload_length = $result[0]['payload_length'];
		$payload_sent = $result[0]['payload_sent'];
		if($payload_length == $payload_sent){
			//update the time_finished for the campaign
			$time_finished = time();
			$result = database::SQL("UPDATE `campaign` SET `time_finished`=? WHERE `id`=?",array('is',$time_finished,$campaign_id));
		}
	}
	
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

exit;
?>