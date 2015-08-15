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

	for($i=0 ; $i< count($admins) ; $i++)
	{
		$campaigns = database::SQL("SELECT COUNT(`campaign`.`id`) AS `campaigns` FROM `campaign`,`admin` WHERE `campaign`.`secret_key`=`admin`.`secret` AND `admin`.`id`=?",array('i',$admins[$i]['id']));
		$admins[$i]['campaigns'] = $campaigns[0]['campaigns'];
	}

	$_ADMIN_VIEW_ = true;
?>