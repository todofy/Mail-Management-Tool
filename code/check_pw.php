<?php
//get the hash
if(!isset($_GET['link']))
	redirect_to("index.php");
$hash = $_GET['link'];
//check this hash in the database
$result = database::SQL("SELECT `email_id` , `time_started` FROM `pass_verify` WHERE `hash` = ? LIMIT 1" , array('s' , $hash));
if(empty($result))
	redirect_to("index.php");
$email = $result[0]['email_id'];
$time_started = $result[0]['time_started'];
$current_time = time();
$success = true;
$err = "";
if($current_time-$time_started < (15*60))
{
	$success = false;
	$err = "Session ended. Retry!!";
}
else
{
	//end the session
	$result = database::SQL("UPDATE pass_verify SET time_started = time_started-16*60 WHERE email_id = ? LIMIT 1" , array('s' , $email));
}
$_CHECK_PASSWORD_ = true;
?>