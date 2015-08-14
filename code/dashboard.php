<?php

$sessObj = new session();

if (!$sessObj->state) {
    redirect_to("index.php");
}

$id = session::getUserID();
$newuser = new user($id);

$campaigns = database::SQL("SELECT `campaign`.`id` AS `id`, `email`, `api_code`, `payload_length`, SUM(`clicks`) AS `clicks`, `campaign`.`time_started`, `campaign`.`time_finished` FROM `campaign`,`admin`,`mail`,`link_hash` WHERE `campaign`.`secret_key`=`admin`.`secret` AND `mail`.`campaign_id`=`campaign`.`id` AND `mail`.`id`=`link_hash`.`mail_id` GROUP BY `campaign`.`id`");

$_CODE_DASHBOARD_ = true;
?>