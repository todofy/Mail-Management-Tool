<?php
	$token = $data['token'];
	$password = $data['new_pw'];
	//check if email id already in use or not
	$result = database::SQL("SELECT `id` FROM `admin` WHERE `token` = ? LIMIT 1", array('s', $token));

	if(empty($result)){
		$output['error'] = true;
		$output['message'] = 'Not a registered user!';
	}
	else
	{
		$id = $result[0]['id'];
		///set the password
		$salt = login::getHash(8);
		$hashed_password = login::hashPassword($salt , $password);
		//store the changed password and the hash
		database::SQL("UPDATE `admin` SET `salt` = ?  , `password` = ? WHERE `id`= ? LIMIT 1" , array('ssi' , $salt , $hashed_password , $id));
		//check if no of rows returned=1
		//expire the token
		database::SQL("UPDATE `admin` SET `token` = '' , `token_timeset` = `token_timeset` - 1200 WHERE `id` = ? " , array('i' , $id));
		//set the session
		session::Set($id);
		$output['error'] = false;
		$output['message'] = 'Successfully changed';
	}
?>