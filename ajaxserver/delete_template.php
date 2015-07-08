<?php
    //get id of template to be deleted
	$id = $data['template_id'];
	//check if template present in the database
	$result = database::SQL("SELECT id FROM template WHERE id=?",array('i',$id));
	if(empty($result)){
		$output['error'] = true;
		$output['message'] = 'Template not in the database.';
	}
	else{
		//delete the template from database
		$result = database::SQL("DELETE FROM template WHERE id=?",array('i',$id));
		$output['error'] = false;
		$output['message'] = 'Template deleted.';
	}	
?>