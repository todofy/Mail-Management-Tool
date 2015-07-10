<?php
	//get template name and template text
	$template_name = $data['template-name'];
	$template_text = $data['template-text'];

	//check if template name already in use or not
	$result = database::SQL("SELECT `id` from `template` where `name` = ? LIMIT 1",array('s',$template_name));
	if(!empty($result)){
		$output['error'] = true;
		$output['message'] = 'Template name already in use!';
	}
	else{
		//insert the new template in the database
		//get the time
		$t = time();
		$result = database::SQL("INSERT INTO `template`(`name`,`template` , `created_on` , `last_updated`) VALUES(?,?,?,?)",array('ssii',$template_name,$template_text,$t,$t));

		//check if template is successfully inserted or not
		$result = database::SQL("SELECT `id` from `template` where `name` = ? LIMIT 1",array('s',$template_name));
		$id = $result[0]['id'];
		if($id == null){
			$output['error'] = true;
			$output['message'] = 'Database error! Unable to add template.';
		}
		else{
			$output['error'] = false;
			$output['message'] = 'Template added.';
		}
	}
?>