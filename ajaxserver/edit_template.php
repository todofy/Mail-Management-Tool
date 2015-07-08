<?php
	//get template id, name and template text
	$template_id = $data['template-id'];
	$template_name = $data['template-name'];
	$template_text = $data['template-text'];
	$t = time();

	$result = database::SQL("SELECT `name` FROM `template` WHERE `id`=? LIMIT 1",array('i',$template_id));
	$name = $result[0]['name'];
	if($name == $template_name){
		//name is same as previous name
		$q = database::SQL("UPDATE `template` SET `template`=?,`last_updated`=? WHERE `id`=?",array('sii',$template_text,$t,$template_id));
		$output['error'] = false;
		$output['message'] = 'Template updated.';
	}
	else{
		//name is dfferent than previous name
		$result = database::SQL("SELECT `id` FROM `template` WHERE `name`=? LIMIT 1",array('s',$template_name));
		if(empty($result)){
			//template name not in use
			$result = database::SQL("UPDATE `template` SET `name`=?,`template`=?,`last_updated`=? WHERE `id`=?",array('ssii',$template_name,$template_text,$t,$template_id));
			$output['error'] = false;
			$output['message'] = 'Template updated.';
		}
		else{
			//template name already in use
			$output['error'] = true;
			$output['message'] = 'Template name already in use.';
		}
	}	
	
?>