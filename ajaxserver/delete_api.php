<?php
    //get id of api to be deleted
	$api_id = $data['api_id'];
	//check if api present in the database
	$result = database::SQL("SELECT id FROM api WHERE id=?",array('i',$api_id));
	if(empty($result)){
		$output['error'] = true;
		$output['message'] = 'API not in the database.';
	}
	else{		
		//delete the API from database
		$result = database::SQL("DELETE FROM api WHERE id=?",array('i',$api_id));
		$output['error'] = false;
		$output['message'] = 'API deleted.';
	}		
?>