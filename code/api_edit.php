<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	$templates = database::SQL("SELECT `id`,`name` FROM `template`");

	//Get the id of the API to be edited
	$id = $_GET['id'];

	$result = database::SQL("SELECT `name`,`template_id` FROM `api` WHERE `id`=? LIMIT 1",array('i',$id));
	$api_name = $result[0]['name'];
	$template_id = $result[0]['template_id'];

	$_API_EDIT_ = true;

?>