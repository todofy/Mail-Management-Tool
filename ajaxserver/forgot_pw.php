<?php
//get the email
$email = $data['email'];
//verify if this email even exist in the database ie is it a registered user yet or not
$result = database::SQL("SELECT `id` FROM `admin` WHERE email = ? LIMIT 1" , array('s' , $email));
if(empty($result))
{
	$output['error'] = true;
	$output['message'] = "You are not a registerd user";
}
else
{
	$user_id = $result[0]['id'];
	//now genrate a link
	$hash = login::getHash(16);
	$url = $BASE_URL."reset_pw.php?link=".$hash;
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
		$result = database::SQL("UPDATE `admin` SET `token` = ?  , `token_timeset` = ? WHERE `id` = ? LIMIT 1" , array('sii' , $hash , $t , $user_id ));
		// @todo verify that number of rows affected = 1
		$output['error'] = false;
		$output['message'] = "A mail has been successfully sent to your email for verification";
	} else{
		$output['error'] = true;
		$output['message'] = "Could not send the mail. Make sure you have entered a valid email address";
	}
}

?>