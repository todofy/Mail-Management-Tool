<?php
/**
 * API handler
 */
// all the sdk includes
$SECURE = true;

include __DIR__ .'/../libs/session.php';
include __DIR__ .'/../libs/globals.php';
include __DIR__ .'/../libs/user.php';
include __DIR__ .'/../libs/database.php';

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
	$subject = DEFAULT_SUBJECT;
}

if($data['from']){
	$from = $data['from'];
}
else{
	//get the default sender address from the config file
	$from = DEFAULT_SENDER;
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
$payload = json_encode($payload);

//send output
$output['error'] = false;
$output['message'] = $campaign_id;
echo json_encode($output);

//start the vent
exec("php ../rabbitmq/vent.php $campaign_id $payload");

exit;
?>
