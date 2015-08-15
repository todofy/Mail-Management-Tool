<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	$apis = database::SQL("SELECT `api`.`id`, `code`, `api`.`name`, `template`.`name` as `template_name`, `api`.`created_on` FROM `api`,`template` WHERE `api`.`template_id`=`template`.`id`");

	$_CODE_API_ = true;

?>