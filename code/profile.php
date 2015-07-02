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
	
$_CODE_PROFILE = true;  

?>