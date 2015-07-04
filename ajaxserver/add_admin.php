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
		$secret = login::getHash(64);

		// Generate a random password for the new admin
		$password = login::getHash(8);
		$password_hash = login::hashPassword($password);

		//insert the new entry into the database
		$result = database::SQL("INSERT INTO `admin`(`email`, `secret`, `password`) values (?, ?, ?) ", 
			array('sss', $email, $secret, $password_hash));

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
		if(!empty($access) && is_array($access))
	    foreach ($access as $value){
	    	$result = database::SQL("INSERT into admin_access values (?,?)",array('is',$id,$value));
	    }

	    // TODO - send a mail to new admin along with details and password.

	    //create and send the password

	    //set the output array
	    $output['error'] = false;
	    $output['message'] = 'Successfully added! A Mail has been sent to ' .$email .' with account details';
	}


	finish:
	

?>