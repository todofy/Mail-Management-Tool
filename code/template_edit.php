<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	//Get the id of the template to be edited
	$id = $_GET['id'];
	$result = database::SQL("SELECT `name`,`template` from `template` where `id` = ? LIMIT 1", array('i', $id));

	if(empty($result)) redirect_to("_404.php");
	else{
		$template_name = $result[0]['name'];
		$template_text = $result[0]['template'];
	}
    
	$_TEMPLATE_EDIT_ = true;
?>