<?php
/**
 * API handler
 */
// all the sdk includes
$SECURE = true;

include __DIR__ .'/../libs/session.php';
include __DIR__ .'/../libs/api.php';
include __DIR__ .'/../libs/user.php';
require_once __DIR__ .'/../rabbitmq/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

database::Start();

$output = array(
	'error' => false,
	'message'=>''
	);

//set values according to POST variable
$data = json_decode($_POST['data'],true);
$secret_key = $data['secret_key'];
$api_code = $data['api_code'];
if($data['subject']){
	$subject = $data['subject'];
}
else{
	//get the default subject from the config file
}

if($data['from']){
	$from = $data['from'];
}
else{
	//get the default sender address from the config file
}

$payload = $data['payload'];

//validate the request
$result = database::SQL("SELECT `id` FROM `admin` WHERE `secret` = ? LIMIT 1",array('s',$secret_key));
if(empty($result)){
	//report error and revert back or exit
	$output['error'] = true;
	$output['message'] = 'Non existent secret key.';
	echo json_encode($output);
	exit;
}
$result = database::SQL("SELECT `id` FROM `api` WHERE `code` = ? LIMIT 1",array('s',$api_code));
if(empty($result)){
	//report error and revert back or exit
	$output['error'] = true;
	$output['message'] = 'Non existent API.';
	echo json_encode($output);
	exit;
}

//create a new campaign
$payload_length = count($payload);
$time_started = time();
$campaign_id = login::getHash(10);
$result = database::SQL("INSERT INTO `campaign`(`id`,`secret_key`,`api_code`,`sender`,`subject`,`payload_length`,`time_started`) VALUES(?,?,?,?,?,?,?)",array('sssssii',$campaign_id,$secret_key,$api_code,$from,$subject,$payload_length,$time_started));

//declare exchange
$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->exchange_declare('mail', 'direct', false, false, false);

//generate new mail ids for each entry in payload
for($i=0; $i<$payload_length; $i++) {
	//insert into database each mail
	$payload_json = json_encode($payload[$i]);
	$result = database::SQL("INSERT INTO `mail`(`campaign_id`,`payload`) VALUES(?,?)",array('ss',$campaign_id,$payload_json));
}

//push the mail ids into message queue according to current campaign id
$result = database::SQL("SELECT `id` FROM `mail` WHERE `campaign_id`=?",array('s',$campaign_id));
for ($i=0; $i < count($result); $i++) { 
	$mail_id = $result[$i]['id'];
	$message = new AMQPMessage($mail_id);
	$channel->basic_publish($message, 'mail', 'API');
}

$channel->close();
$connection->close();

$output['error'] = false;
$output['message'] = 'Campaign started with campaign_id: '.$campaign_id;
echo json_encode($output);

exit;
?>
