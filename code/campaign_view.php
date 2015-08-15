<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	$campaign_id = $_GET['id'];
	$error = false;
	$result = database::SQL("SELECT `id` FROM `campaign` WHERE `id`=? LIMIT 1",array('s',$campaign_id));
	if(empty($result))
		$error = true;
	else{
		//get all mails for specific campaign
		$mails = database::SQL("SELECT `mail`.`id`, `description`, `status`, `time_started`, `time_finished` FROM `mail`,`mail_status` WHERE `campaign_id`=? AND `mail`.`status`=`mail_status`.`type`",array('s',$campaign_id));
		
	}
	$_CAMPAIGN_VIEW_ = true;

?>

