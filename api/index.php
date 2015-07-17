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
//get the api name,the secret key and the parameters from the GET variable
$error = false;
if(isset($_GET['api_name']))
{
	$api_name = $_GET['api_name'];
	if(isset($_GET['secret']))
	{
		$secret = $_GET['secret'];
		$len = count($_GET);
		$params = array();
		$i=0;
		foreach ($_GET as $key => $value) {
			if($i>1)
			$params[$key] = $value;
			$i++;
		}
	}
	else
	{
		//wrong key name specified or not given at all
		$error = true;
	}
}
else
{
	//wrong key specified or nothing is sent
	$error = true;
}
//check if the error is true
if($error == true)
{
	redirect_to("_404.php");
}

$api = new api($secret,$api_name,$params);
$unique_id = login::getHash(8);

$api->validate_call();
if($api->state) {
	$mail = $api->replace_params();
}
else {
	echo $api->err;
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
