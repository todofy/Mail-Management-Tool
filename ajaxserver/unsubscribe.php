<?php
	$email = $data['email'];
	$reason_id = $data['reason'];
	$time = time();
	$result = database::SQL("INSERT INTO `unsubscribed`(`email`,`time`,`reason_id`) VALUES(?,?,?)",array('sii',$email,$time,$reason_id));
	$output['error'] = false;
?>