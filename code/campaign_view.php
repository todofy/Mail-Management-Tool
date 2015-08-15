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
		for($i=0 ; $i< count($mails) ; $i++)
		{
			$result = database::SQL("SELECT SUM(`clicks`) AS `clicks` FROM `link_hash` WHERE `mail_id` = ? " , array('i' , $mails[$i]['id']));
			if(!isset($result[0]['clicks']))
			{
				$mails[$i]['clicks'] = '-';
			}
			else
			{
				$mails[$i]['clicks'] = $result[0]['clicks'];
			}
		}
	}
	$_CAMPAIGN_VIEW_ = true;

?>

