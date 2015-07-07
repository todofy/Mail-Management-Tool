<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	$templates = database::SQL("SELECT `name` FROM `template`");

	$_API_ADD = true;

?>