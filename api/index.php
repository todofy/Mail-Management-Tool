<?php
/**
 * API handler
 */

session_start();
$SECURE = true;

if (!$sessObj->state) {
	$err = 'Login before trying to call API.';
	redirect_to('../index.php?err='.$err);
}

// all the sdk includes
include __DIR__ .'/../libs/login.php';
include __DIR__ .'/../libs/api.php';
require_once __DIR__ .'/../JSON/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

database::Start();

//set values according to POST variable
$secret_key = $_POST['secret_key'];
$api_code = $_POST['api_code'];
if($_POST['subject']){
	$subject = $_POST['subject'];
}
else{
	//get the default subject from the config file
}

if($_POST['from']){
	$from = $_POST['from'];
}
else{
	//get the default sender address from the config file
}

$payload = $_POST['payload'];

//validate the request
$result = database::SQL("SELECT FROM `admin` WHERE `secret` = ? LIMIT 1",array('s',$secret_key));
if(empty($result)){
	//report error and revert back or exit
}
$result = database::SQL("SELECT FROM `api` WHERE `code` = ? LIMIT 1".array('s',$api_code));
if(empty($result)){
	//report error and revert back or exit
}

//create a new campaign
$payload_length = count($payload);
$time_started = time();
$campaign_id = login::getHash(10);
$result = database::SQL("INSERT INTO `campaign`(`id`,`secret_key`,`api_code`,`sender`,`subject`,`payload_length`,`time_started`) VALUES(?,?,?,?,?,?,?)",array('ssssii',$campaign_id,$secret_key,$api_code,$from,$subject,$payload_length,$time_started));

//declare exchange
$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->exchange_declare('mail', 'direct', false, false, false);

//generate new mail ids for each entry in payload
foreach ($payload as $value) {
	//insert into database each mail
	$result = database::SQL("INSERT INTO `mail`(`campaign_id`,`payload`) VALUES(?,?)",array('ss',$campaign_id,$payload_json));
}

//push the mail ids into message queue according to current campaign id
$result = database::SQL("SELECT FROM `mail` WHERE `campaign_id`=?",array('s',$campaign_id));
for ($i=0; $i < count($result); $i++) { 
	$mail_id = $result[$i]['id'];
	$message = new AMQPMessage($id);
	$channel->basic_publish($message, 'mail', 'API');
}

$channel->close();
$connection->close();

redirect_to('../api_handler.php?mail_id='.$campaign_id);

exit;
?>
