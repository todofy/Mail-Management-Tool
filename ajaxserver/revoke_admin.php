<?php
    //get id of admin to be deleted
	$id = $data['admin_id'];
	//check if admin present in the database
	$result = database::SQL("SELECT id, secret , email FROM admin WHERE id=?",array('i',$id));
	if(empty($result)){
		$output['error'] = true;
		$output['message'] = "Admin doesn't exist in the database.";
		logging::log('AJAXSERVER, revoke_admin.php, api called with incorrect admin id', LOG_ERROR);
	}
	else{
		$old_secret = $result[0]['secret'];
		$new_secret = login::getHash(32);
		$email = $result[0]['email'];
		//set secret key of admin to new secret key
		$result = database::SQL("UPDATE admin SET secret = ? WHERE id=?",array('si', $new_secret, $id));
		//update the campaigns already called by the admin
		$result = database::SQL("UPDATE campaign SET secret_key = ? WHERE secret_key = ?",array('ss',$new_secret,$old_secret));

		// send a mail to this admin regarding new API key and things
		$template = "Your secret key has been revoked. New secret key is : ".$new_secret;
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
			$output['error'] = false;
			$output['message'] = 'Secret key of admin revoked.';
			$output['data'] = $new_secret;
		}
		else{
			$output['error'] = true;
			$output['message'] = "Mail could not be sent to the email id";
			//change the secret key again
			//revert back the changes
			$result = database::SQL("UPDATE admin SET secret = ? WHERE id=?",array('si', $old_secret, $id));
			//update the campaigns already called by the admin
			$result = database::SQL("UPDATE campaign SET secret_key = ? WHERE secret_key = ?",array('ss',$old_secret,$new_secret));
		}
	}	
?>