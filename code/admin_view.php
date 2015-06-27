<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	if (!isset($newuser->access[VIEW_ADMIN])) {
		redirect_to("_404.php");
	}

	$admins = database::SQL("SELECT `id`, `email`, `last_login` FROM `admin`");

	$_ADMIN_VIEW_ = true;
?>