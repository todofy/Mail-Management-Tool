<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	if (!isset($newuser->access[EDIT_ADMIN])) {
		redirect_to("_404.php");
	}

	//Get the email of the user to be edited
	$id = $_GET['id'];
	$result = database::SQL("SELECT `email` from `admin` where `id` = ? LIMIT 1", array('i', $id));

	if(empty($result)) redirect_to("_404.php");
	else $email = $result[0]['email'];

	$accessForThisAdmin = database::SQL("SELECT `access_id` FROM `admin_access` WHERE `admin_id` = ?", array('i', $id));

	// Get all possible accesses
	$accesses = database::SQL("SELECT `id`, `name`, `description` FROM `acl`");

	//Get email id for the id posted to this page
    
	$_ADMIN_EDIT_ = true;
?>