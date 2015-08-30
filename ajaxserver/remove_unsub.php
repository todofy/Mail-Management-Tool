<?php
    //get user_id of email to be removed
	$user_id = $data['user_id'];
	//check if email present in the database
	$result = database::SQL("SELECT `user_id` FROM `unsubscribed` WHERE `user_id`=?",array('i',$user_id));
	if(empty($result)){
		$output['error'] = true;
		$output['message'] = 'Email not in database.';
	}
	else{		
		//remove the email from unsubscriptions
		$result = database::SQL("DELETE FROM `unsubscribed` WHERE `user_id`=?",array('i',$user_id));
		$output['error'] = false;
		$output['message'] = 'Email removed from unsubscriptions.';
	}		
?>