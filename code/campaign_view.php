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
	$template = database::SQL("SELECT `template`.`id` AS `id` FROM `campaign`,`api`,`template` WHERE `campaign`.`id`=? AND `api_code`=`api`.`code` AND `template_id`=`template`.`id` GROUP BY `campaign`.`id` LIMIT 1",array('s',$campaign_id));
	$template_id = $template[0]['id'];
	if(empty($result))
		$error = true;
	else{
		//get all mails for specific campaign
		$mails = database::SQL("SELECT `mail`.`id`, `description`, `payload`, `status`, `time_started`, `time_finished` FROM `mail`,`mail_status` WHERE `campaign_id`=? AND `mail`.`status`=`mail_status`.`type`",array('s',$campaign_id));
		for($i=0 ; $i< count($mails) ; $i++)
		{
			$payload = json_decode($mails[$i]['payload'],true);
			if(isset($payload['to']))
				$mails[$i]['sent_to'] = $payload['to'];
			else
				$mails[$i]['sent_to'] = '---NA---';
			
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

