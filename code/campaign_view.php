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
<<<<<<< HEAD
		$mails = database::SQL("SELECT `mail`.`id`, `description`, `status`, `time_started`, `time_finished` FROM `mail`,`mail_status` WHERE `campaign_id`=? AND `mail`.`status`=`mail_status`.`type`",array('s',$campaign_id));
		
=======
		$mails = database::SQL("SELECT `mail`.`id`, `description`, `status`, `time_started`, `time_finished`, SUM(`clicks`) as `clicks` FROM `mail`,`mail_status`,`link_hash` WHERE `campaign_id`=? AND `mail`.`status`=`mail_status`.`type` AND `mail`.`id`=`link_hash`.`mail_id` GROUP BY `link_hash`.`mail_id`",array('s',$campaign_id));
>>>>>>> origin/master
	}
	$_CAMPAIGN_VIEW_ = true;

?>

