<?php
	$email = $data['email'];
	//check if the email is valid and set the output array accordingly
    $access = $data['access[]'];
	//check if email id already in use or not
	$result = database::SQL("SELECT id FROM admin WHERE email = ? LIMIT 1", array('s', $email));

	if(!empty($result)){
		$output['error'] = true;
		$output['message'] = 'Email id already in use!';
	}
	else
	{
		// Generate an API Key for the admin
		$secret = login::getHash(32);

		// Generate a random password for the new admin
		$password = login::getHash(8);
		$salt = login::getHash(6);
		$password_hash = login::hashPassword($salt,$password);

		//insert the new entry into the database
		$result = database::SQL("INSERT INTO `admin`(`email`, `secret`, `password`,`salt`) values (?, ?, ?, ?) ", 
			array('ssss', $email, $secret, $password_hash, $salt));

		//get the id for the new user
		$result = database::SQL("SELECT id from admin where email = ? LIMIT 1",array('s',$email));
		$id = $result[0]['id'];

		if ($id == null) {
			// The user was not inserted
			$output['error'] = true;
		    $output['message'] = 'Unable to add an admin! Database Error!';
		    goto finish;
		}

		//insert the access rights for the user in database
		if(!empty($access)){
			if(is_array($access)){
	    		foreach ($access as $value){
	    			$result = database::SQL("INSERT into admin_access values (?,?)",array('is',$id,$value));
	    		}
	    	} else
	    	$result = database::SQL("INSERT into admin_access values (?,?)",array('is',$id,$access));
	    }

	    //send the password to their email
		$template = '<p><span style="font-size: 14px; font-family: \'Comic Sans MS\';">You have been registered as an admin on Todofy for this organisation.</span></p>
					<p><span style="font-size: 14px; font-family: \'Comic Sans MS\';">Your username is your email id : <span style="color: #0000ff;">'.$email.'</span></span></p>
					<p><span style="font-size: 14px; font-family: \'Comic Sans MS\';">Your randomly generated password is <span style="color: #0000ff;">'.$password.'</span> and secret key for API calls is <span style="color: #0000ff;">'.$secret.'</span>.</span></p>
					<p><em><span style="font-size: 14px; font-family: \'Comic Sans MS\';">(You can change your password by logging in and going to \'Profile\'. You can also view your access rights in your profile section.)</span></em></p>
					<p></p>
					<p><span style="font-size: 12px; font-family: Verdana;"><a title="Todofy" href="'..$BASE_URL'" target="_blank">Click this link to go to Todofy homepage</a></span></p>';
		//send the mail
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
    		$output['message'] = 'Successfully added! A Mail has been sent to ' .$email .' with account details';
		}
		else
		{
			//delete the entry for this admin
			$result = database::SQL("DELETE FROM admin WHERE id = ? LIMIT 1" , array('i' , $id));
			//delete the accesses
			$result = database::SQL("DELETE FROM admin_access WHERE admin_id = ?" , array('i' , $id));
			$output['error'] = true ; 
			$output['message'] = "Mail cannot be sent. Check if vallid email is provided !!";
		}
	    
	}


	finish:
	

?>