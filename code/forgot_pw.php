<?php
if(!isset($_POST['email']))
{
	redirect_to("index.php");
}
$success = true;
$err = "";
$email = $_POST['email'];
//verify if this email even exist in the database ie is it a registered user yet or not
$result = database::SQL("SELECT `id` FROM `admin` WHERE email = ? LIMIT 1" , array('s' , $email));
if(empty($result))
{
	$success = false;
	$err = "You are not a registerd user";
}
else
{
	$user_id = $result[0]['id'];
}
if($success)
{
	//now genrate a link
	$hash = login::getHash(16);
	$url = $BASE_URL."check_pw.php?link=".$hash;
	//delete any previous entry in the table with the same email id ie tried befire but not verified
	$result = database::SQL('DELETE FROM `pass_verify` WHERE `email_id` = ? ' , array('s' , $email));
	//get the template
	$template = "<a href='".$url."'>click on this link to verify</a>";
	//send the mail @todo
	$to = $email; 
	$from = DEFAULT_SENDER ; 
	$subject = DEFAULT_SUBJECT ; 
	$headers = "From: " .$from. "\r\n";
	$headers .= "Reply-To: contact@todofy.org\r\n";
	$headers .= "Return-Path: return@todofy.org\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	if(mail($to,$subject,$template,$headers)) {
		//mail sent successfully
		//save the email , time and the hash in the database
		$t = time();
		$result = database::SQL("INSERT INTO `pass_verify`(`email_id` , `hash` , `time_started` ) VALUES (? , ? , ?)" , array('ssi' , $email , $hash , $t ));
		// @todo verify that number of rows affected = 1
		//get the id of the SQL entry : might be useful later on
		$result = database::SQL("SELECT `user_id` FROM `pass_verify` WHERE `email_id` = ? LIMIT 1" , array('s' , $email));
		$verify_id = $result[0]['user_id'];
	} else{
		$success = false;
		$t = time();
		$err = "Could not send the mail. Make sure you have entered a valid email address";
	}
}

$_FORGOT_PASSWORD_ = true;
?>