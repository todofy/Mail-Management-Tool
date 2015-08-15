<?php
$SECURE = true;

include __DIR__ .'/../libs/database.php';
include __DIR__ .'/../libs/api.php';

database::Start();

require_once '/vendor/autoload.php';
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
	//check status of mail id received
	$result = database::SQL("SELECT `status` FROM `mail` WHERE `id`=? LIMIT 1",array('i',$mail_id));
	if($result[0]['status']==0){
		//process the mail
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
			//update status of mail in database
			echo "\n";
			echo $api->err;
			$result = database::SQL("UPDATE `mail` SET `status`=? WHERE `id`=?",array('ii',$api->err,$mail_id));
			$result = database::SQL("UPDATE `campaign` SET `mails_processed`=`mails_processed`+1 WHERE `id`=?",array('s',$campaign_id));
			exit;
		}
		else
		{
			$mail = $api->replace_params_links();
			$to = $api->send_to();
			echo "\n";
			echo $mail;

			//send mail
			//mail($to,$subject,$mail,$from);
			//update database
			$time_finished = time();
			$result = database::SQL("UPDATE `mail` SET `time_finished`=?,`status`=1 WHERE `id`=?",array('ii',$time_finished,$mail_id));
			$result = database::SQL("UPDATE `campaign` SET `mails_processed`=`mails_processed`+1 WHERE `id`=?",array('s',$campaign_id));
		}
	}	
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

exit;
?>