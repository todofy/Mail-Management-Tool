<?php
	//get salt stored for the admin
	$result = database::SQL("SELECT salt FROM admin WHERE id = ? LIMIT 1",array('s', $admin_id));
	$salt = $result[0]['salt'];
	//set current password and new password accordingly
	$current_pw = md5(($salt) . ($data['current_pw']));
	$new_pw = md5(($salt) . ($data['new_pw']));
	$result = database::SQL("SELECT password FROM admin WHERE id = ? LIMIT 1", array('i', $admin_id));
	//check if password entered and password in database match or not
	if($current_pw != $result[0]['password']){
		$output['error'] = true;
		$output['message'] = 'Password incorrect!';
	}
	else
	{
		//insert the new password in database
		$result = database::SQL("UPDATE admin SET password=? WHERE id = ?",array('si',$new_pw,$admin_id));
	    $output['error']=false;
	    $output['message']='Password changed';
	}
	

?>