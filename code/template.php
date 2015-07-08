<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	$templates = database::SQL("SELECT `id`, `name`, `created_on`, `last_updated` FROM `template`");

	$_CODE_TEMPLATE = true;

?>