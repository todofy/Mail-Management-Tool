<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	// Get all possible accesses
	$accesses = database::SQL("SELECT `id`, `name`, `description` FROM `acl`");

	$_ADMIN_ADD_ = true;
?>