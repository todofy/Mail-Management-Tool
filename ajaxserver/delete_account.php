<?php
	//get salt stored for the admin
	$result = database::SQL("SELECT salt FROM admin WHERE id = ? LIMIT 1",array('s', $admin_id));
	$salt = $result[0]['salt'];
	//check if password correct or not
	$password = md5(($salt) . ($data['pwd']));
	$result = database::SQL("SELECT password FROM admin WHERE id = ? LIMIT 1", array('i', $admin_id));
	if($password != $result[0]['password']){
		$output['error'] = true;
		$output['message'] = 'Incorrect password.';
	}
	else{
		//delete all accesses of admin from database
		$result = database::SQL("DELETE FROM admin_access WHERE admin_id=?",array('i',$admin_id));
		//delete the admin from database
		$result = database::SQL("DELETE FROM admin WHERE id=?",array('i',$admin_id));
		$output['error'] = false;
		$output['message'] = 'Account deleted.';
	}	
?>
