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

//get campaign_id and payload passed in arguments array
//$campaign_id = $argv[1];
//$payload = json_decode($argv[2],true);
$campaign_id = '0572051252';
$string = '[{"to":"anshumanpattanayak@gmail.com"},{"to":"anshuman@gmail.com"}]';
$payload = json_decode($string,true);
$payload_length = count($payload);

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('mailing_queue', false, true, false, false);
$channel->exchange_declare('sink_ack', 'fanout', false, false, false);

//generate new mail ids for each entry in payload
for($i=0; $i<$payload_length; $i++) {
	//insert into database each mail
	$payload_json = json_encode($payload[$i]);
	$result = database::SQL("INSERT INTO `mail`(`campaign_id`,`payload`) VALUES(?,?)",array('ss',$campaign_id,$payload_json));
}

//decide how many workers to spawn
if($payload_length > 30){
	$workers = 30;
}
else{
	$workers = $payload_length;
}

//start the sink
exec("php sink.php $campaign_id > $BASE_URL/logs 2>&1 & echo $!",$op);

//spawn workers
for ($i=0; $i < $workers; $i++) { 
	$op = exec("php worker.php > $BASE_URL/logs 2>&1 & echo $!", $op);
}

//push the mail ids into message queue according to current campaign id
$result = database::SQL("SELECT `id` FROM `mail` WHERE `campaign_id`=?",array('s',$campaign_id));
foreach($result as $value) { 
	$mail_id = $value['id'];
	$message = new AMQPMessage($mail_id);
	$channel->basic_publish($message, '', 'mailing_queue');
	$result = database::SQL("UPDATE `campaign` SET `payload_sent`=`payload_sent`+1 WHERE `id`=?",array('s',$campaign_id));
}

//issue kill commands for the workers spawned
for ($i=0; $i < $workers; $i++) {
	$kill = new AMQPMessage('kill'); 
	$channel->basic_publish($kill, '', 'mailing_queue');
}

list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

$channel->queue_bind($queue_name, 'sink_ack');

//wait for acknowledgement from sink
$callback = function($message){
	if($message->body == $campaign_id){
		$time_finished = time();
		$result = database::SQL("UPDATE `campaign` SET `time_finished`=? WHERE `campaign_id`=?",array('is',$time_finished,$campaign_id));
		$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);	
		exit;
	}
	$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);	
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

exit;
?>
