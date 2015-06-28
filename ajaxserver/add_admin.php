<?php
	$email = $data['email'];
    $access = $data['access'];
	//check if email id already in use or not
	$result = database::SQL("SELECT id FROM admin WHERE email = ? LIMIT 1", array('s', $email));

	if(!empty($result)){
		$output['error'] = true;
		$output['message'] = 'Email id already in use!';
		echo json_encode($output);
	}

	//insert the new entry into the database
	$result = database::SQL("INSERT into admin(email) values (?) ", array('s', $email));

	//get the id for the new user
	$id = database::SQL("SELECT id from admin where email = ? LIMIT 1",array('s',$email));

	//insert the access rights for the user in database
    foreach ($access as $value){
    	$result = database::SQL("INSERT into admin_access values (?,?)",array('ss',$id,$value));
    }

?>