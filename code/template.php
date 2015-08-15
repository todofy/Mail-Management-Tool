<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	$templates = database::SQL("SELECT `id`, `name`, `created_on`, `last_updated` FROM `template`");

	for($i=0 ; $i< count($templates) ; $i++)
		{
			$params = database::SQL("SELECT COUNT(`name`) AS `parameters` FROM `api_params` WHERE `template_id`=?",array('i',$templates[$i]['id']));
			$templates[$i]['parameters'] = $params[0]['parameters'];
			$links = database::SQL("SELECT COUNT(`url`) AS `links` FROM `links` WHERE `template_id`=?",array('i',$templates[$i]['id']));
			$templates[$i]['links'] = $links[0]['links'];
		}

	$_CODE_TEMPLATE_ = true;

?>