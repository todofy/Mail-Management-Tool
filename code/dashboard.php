<?php

$sessObj = new session();

if (!$sessObj->state) {
    redirect_to("index.php");
}

$id = session::getUserID();
$newuser = new user($id);

$campaigns = database::SQL("SELECT `id`, `subject`, `api_code`, `payload_length`, `mails_processed`, `time_started`, `time_finished` FROM `campaign` ORDER BY `time_started` DESC");

if(!empty($campaigns)){
	for ($i=0; $i < count($campaigns); $i++){
		$clicks = database::SQL("SELECT SUM(`clicks`) AS `clicks` FROM `mail`,`link_hash` WHERE `mail`.`id`=`link_hash`.`mail_id` AND `campaign_id`=? GROUP BY `campaign_id`",array('s',$campaigns[$i]['id']));
		if (empty($clicks))
			$campaigns[$i]['clicks'] = 0;
		else
			$campaigns[$i]['clicks'] = $clicks[0]['clicks'];
	}
}

$_CODE_DASHBOARD_ = true;
?>