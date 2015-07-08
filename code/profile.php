<?php
$sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	//email of user
	$result = database::SQL("SELECT `email` FROM `admin` WHERE id=?",array('i',$id));
	$email = $result[0]['email'];

	$adminAccess = database::SQL("SELECT `name` FROM `admin_access`	INNER JOIN `acl` ON `acl`.`id` = `admin_access`.`access_id`
				   WHERE admin_id = ?", array('i', $id));

	$_CODE_PROFILE = true;  

?>