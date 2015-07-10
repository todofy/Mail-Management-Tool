<?php
	//get id of the template to be previewed
	$template_id = $data['template_id'];
	//check if template in database or not
	$result = database::SQL("SELECT `template` FROM `template` WHERE `id` = ? LIMIT 1",array('i',$template_id));
	if(empty($result)){
		$output['error'] = true;
		$output['message'] = "Template doesn't exist in the database.";
		$output['data'] = "Unable to load preview.";
	}
	else{
		//get template text from database
		$template_text = $result[0]['template'];
		$output['error'] = false;
		//return template text
		$output['message'] = "Preview loaded.";
		$output['data'] = $template_text;
	}
?>