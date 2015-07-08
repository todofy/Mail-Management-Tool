<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	$apis = database::SQL("SELECT `id`, `code`, `name`, `template_id`, `created_on` FROM `api`");

	$_CODE_API_ = true;

?>