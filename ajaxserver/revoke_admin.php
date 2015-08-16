<?php
    //get id of admin to be deleted
	$id = $data['admin_id'];
	//check if admin present in the database
	$result = database::SQL("SELECT id, secret FROM admin WHERE id=?",array('i',$id));
	if(empty($result)){
		$output['error'] = true;
		$output['message'] = "Admin doesn't exist in the database.";
		logging::log('AJAXSERVER, revoke_admin.php, api called with incorrect admin id', LOG_ERROR);
	}
	else{
		$old_secret = $result[0]['secret'];
		$new_secret = login::getHash(32);
		//set secret key of admin to new secret key
		$result = database::SQL("UPDATE admin SET secret = ? WHERE id=?",array('si', $new_secret, $id));
		//update the campaigns already called by the admin
		$result = database::SQL("UPDATE campaign SET secret_key = ? WHERE secret_key = ?",array('ss',$new_secret,$old_secret));
		$output['error'] = false;
		$output['message'] = 'Secret key of admin revoked.';
		$output['data'] = $new_secret;

		// TODO - send a mail to this admin regarding new API key and things
	}	
?>