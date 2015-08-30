<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	if (!isset($newuser->access[UNSUB_EMAILS])) {
		redirect_to("_404.php");
	}

	$unsubs = database::SQL("SELECT `user_id`, `email`, `time`, `reason` FROM `unsubscribed`,`unsub_reasons` WHERE `unsubscribed`.`reason_id`=`unsub_reasons`.`id`");

	$_UNSUBS_ACCESS_ = true;

?>