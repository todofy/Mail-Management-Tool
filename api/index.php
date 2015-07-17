<?php
/**
 * API handler
 */

session_start();
$SECURE = true;

// all the sdk includes
include __DIR__ .'/../libs/login.php';
include __DIR__ .'/../libs/api.php';

/*foreach ($_GET as $key => $value){
	$query[] = $value;
}

$secret_key = $query[0];
$api_name = $query[1];
for ($i=2; $i < count($query); $i++) { 
	$params[] = $query[$i];
}*/

database::Start();

$api = new api("7be1f7a994a0cb2d9921a19fef9c52ae","API_Registration",array("zsonix27@gmail.com","paswrd","7be1f7a994a0cb2d9921a19fef9c52ae"));
$unique_id = login::getHash(8);

if($api->state){
	$api->validate_call();
	if($api->state) {
		$mail = $api->replace_params();
	}
	else echo $api->err;
}
else{
	echo "Check parameters passed";
}

//push the mail into message queue
require_once '../JSON/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('mail', 'direct', false, false, false);

$message = new AMQPMessage($mail);

$channel->basic_publish($message, 'mail', 'dummy');

echo "Mail pushed to exchange. \n";

$channel->close();
$connection->close();

?>
