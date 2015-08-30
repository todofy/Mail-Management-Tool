<?php

if(!isset($_GET['id']))
	redirect_to("_404.php");

$mail_id = $_GET['id'];

$result = database::SQL("SELECT `payload` FROM `mail` WHERE `id`=? LIMIT 1",array('i',$mail_id));

if(empty($result))
	redirect_to("_404.php");

$payload = json_decode($result[0]['payload'],true);

$email = $payload['to'];

$result = database::SQL("SELECT `user_id` FROM `unsubscribed` WHERE `email`=? LIMIT 1",array('s',$email));

$error = false;

if(!empty($result)){
	$error = true;
}
else{
	$reasons = database::SQL("SELECT `id`, `reason` FROM `unsub_reasons`");
}

$_CODE_UNSUB_ = true;

?>