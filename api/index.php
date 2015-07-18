<?php
/**
 * API handler
 */

session_start();
$SECURE = true;

// all the sdk includes
include __DIR__ .'/../libs/login.php';
include __DIR__ .'/../libs/api.php';

//check if logged in or not
$sessObj = new session();
if (!$sessObj->state) {
	$err = 'Login before trying to call API.';
	redirect_to('../index.php?err='.$err);
}

database::Start();

//check if it is possible to push to the queue
$result = database::SQL("SELECT `id` FROM `queue`");
if(empty($result)){
	$err = 'Cannot send mail right now. Please try again later.';
	redirect_to('../api_handler.php?err='.$err);
	exit;
}

//get the api name,the secret key and the parameters from the GET variable
$error = false;
if(isset($_GET['api_name']))
{
	$api_name = $_GET['api_name'];
	if(isset($_GET['secret_key']))
	{
		$secret_key = $_GET['secret_key'];
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
		$err = 'Check query keys and try again';
	}
}
else
{
	//wrong key specified or nothing is sent
	$error = true;
	$err = 'Check query keys and try again';
}
//check if the error is true
if($error == true)
{
	redirect_to('../api_handler.php?err='.$err);
	exit;
}

$api = new api($secret_key,$api_name,$params);
$unique_id = login::getHash(10);
$mail = '';

//validate API call
$api->validate_call();

//Execute according to API state
if($api->state) {
	//generate mail
	$mail = $api->replace_params();
	$api_id = $api->id();
	//create a campaign
	$time = time();
	$result = database::SQL("INSERT INTO `campaign`(`id`,`api_id`,`payload`,`called_on`) VALUES(?,?,?,?)",array('sisi',$unique_id,$api_id,$mail,$time));
	$result = database::SQL("SELECT `id` FROM `campaign` WHERE `id`=? LIMIT 1",array('s',$unique_id));
	if(!empty($result)){
		$campaign_id = $result[0]['id'];
		//insert the mail in database
		$result = database::SQL("INSERT INTO `mail`(`campaign_id`) VALUES(?)",array('s',$campaign_id));
		$result = database::SQL("SELECT `id` FROM `mail` WHERE `campaign_id`=? LIMIT 1",array('s',$campaign_id));
		if(empty($result)){
			$err = 'Database error! Try again.';
			redirect_to('../api_handler.php?err='.$err);
			exit;
		}
		else $mail_id = $result[0]['id'];
	}
	else{
		$err = 'Database error! Try again.';
		redirect_to('../api_handler.php?err='.$err);
		exit;
	}
}
else {
	redirect_to('../api_handler.php?err='.$api->err);
	exit;
}

//push the mail into message queue
require_once __DIR__ .'/../JSON/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('mail', 'direct', false, false, false);

$message = new AMQPMessage($mail);

$channel->basic_publish($message, 'mail', 'API');

$channel->close();
$connection->close();

redirect_to('../api_handler.php?mail_id='.$mail_id);

exit;
?>
