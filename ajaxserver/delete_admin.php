<?php
    //get id of admin to be deleted
	$id = $data['admin_id'];
	//check if admin present in the database
	$result = database::SQL("SELECT id FROM admin WHERE id=?",array('s',$id));
	if(empty($result)){
		$output['error'] = true;
		$output['message'] = 'Admin not in the database.';
	}
	else{
		//delete all accesses of admin from database
		$result = database::SQL("DELETE FROM admin_access WHERE admin_id=?",array('s',$id));
		//delete the admin from database
		$result = database::SQL("DELETE FROM admin WHERE admin_id=?",array('s'),$id);
		$output['error'] = false;
		$output['message'] = 'Admin deleted.';
	}	
?>