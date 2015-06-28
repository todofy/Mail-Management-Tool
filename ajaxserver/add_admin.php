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
		//insert the new entry into the database
		$result = database::SQL("INSERT into admin(email) values (?) ", array('s', $email));

		//get the id for the new user
		$result = database::SQL("SELECT id from admin where email = ? LIMIT 1",array('s',$email));
		$id = $result[0]['id'];
		//insert the access rights for the user in database
		if(!empty($access) && is_array($access))
	    foreach ($access as $value){
	    	$result = database::SQL("INSERT into admin_access values (?,?)",array('is',$id,$value));
	    }

	    //create and send the password

	    //set the output array
	    $output['error']=false;
	    $output['message']='Successfully added';
	}
	

?>