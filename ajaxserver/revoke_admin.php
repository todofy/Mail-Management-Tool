<?php
    //get id of admin to be deleted
	$id = $data['admin_id'];
	//check if admin present in the database
	$result = database::SQL("SELECT id FROM admin WHERE id=?",array('i',$id));
	if(empty($result)){
		$output['error'] = true;
		$output['message'] = 'Admin not in the database.';
	}
	else{
		//set secret key of admin to null
		$result = database::SQL("UPDATE admin SET  secret = null WHERE id=?",array('i',$id));
		$output['error'] = false;
		$output['message'] = 'Secret key of admin revoked.';
	}	
?>