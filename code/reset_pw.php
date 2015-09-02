<?php
//get the hash
if(!isset($_GET['token']))
	redirect_to("index.php");
$hash = $_GET['token'];
//check this hash in the database
$result = database::SQL("SELECT `email` , `token_timeset` FROM `admin` WHERE `token` = ? LIMIT 1" , array('s' , $hash));
if(empty($result))
	redirect_to("index.php");
$email = $result[0]['email'];
$time_started = $result[0]['token_timeset'];
$current_time = time();
$success = true;
$err = "";
if(($current_time-$time_started) > (15*60))
{
	$success = false;
	$err = "Session ended. Retry!!";
}
else
{
	//end the session
	//$result = database::SQL("UPDATE pass_verify SET time_started = time_started-16*60 WHERE email_id = ? LIMIT 1" , array('s' , $email));
}

$_RESET_PW_ = true;

?>