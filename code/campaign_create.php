<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	//check if addding a campaign is a right
	/*
	if (!isset($newuser->access[ADD_CAMPAIGN])) {
		redirect_to("_404.php");
	}

	*/

	// Get all APIs
	$API = database::SQL("SELECT `code` FROM `api`");

	$_CAMPAIGN_CREATE_ = true;
?>