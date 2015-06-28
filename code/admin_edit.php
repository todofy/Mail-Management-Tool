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

	// Get all possible accesses
	$accesses = database::SQL("SELECT `id`, `name`, `description` FROM `acl`");

	//Get email id for the id posted to this page
    
	$_ADMIN_EDIT_ = true;
?>