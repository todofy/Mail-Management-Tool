<?php

$sessObj = new session();

if (!$sessObj->state) {
    redirect_to("index.php");
}

$id = session::getUserID();
$newuser = new user($id);

$result = database::SQL("SELECT `id` FROM `admin` WHERE `id`=? LIMIT 1",array('i',$id));

$campaigns = database::SQL("SELECT `campaign`.`id` AS `id`, `subject`, `api_code`, `payload_length`, `mails_processed`, SUM(`clicks`) AS `clicks`, `campaign`.`time_started`, `campaign`.`time_finished` FROM `campaign`,`admin`,`mail`,`link_hash` WHERE `campaign`.`secret_key`=`admin`.`secret` AND `mail`.`campaign_id`=`campaign`.`id` AND `mail`.`id`=`link_hash`.`mail_id` AND `admin`.`id`=? GROUP BY `campaign`.`id` ORDER BY `campaign`.`time_started` DESC",array('i',$id));

$_CODE_DASHBOARD_ = true;
?>