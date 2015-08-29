<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	if (!isset($newuser->access[CALL_CAMPAIGN])) {
		redirect_to("_404.php");
	}

	// Get all APIs
	$API = database::SQL("SELECT `code` FROM `api`");
	if(empty($API))
		$api_found = false;
	else
		$api_found = true;

	$_CAMPAIGN_CREATE_ = true;
?>