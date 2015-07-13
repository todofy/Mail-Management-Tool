<?php
	//get template id, name, template text, time and parameters
	$template_id = $data['template-id'];
	$template_name = $data['template-name'];
	$template_text = $data['template-text'];
	$t = time();
	preg_match_all('/{{(.*?)}}/', $template_text, $params);

	if(empty($params)){
		$output['error'] = true;
		$output['message'] = 'Empty parameter list!';
	}
	else{
		$result = database::SQL("SELECT `name` FROM `template` WHERE `id`=? LIMIT 1",array('i',$template_id));
		$name = $result[0]['name'];
		if($name == $template_name){
			//name is same as previous name
			$result = database::SQL("UPDATE `template` SET `template`=?,`last_updated`=? WHERE `id`=?",array('sii',$template_text,$t,$template_id));
			//update parameter list
			$result = database::SQL("DELETE FROM `api_params` WHERE `template_id` = ?",array('i',$template_id));
			$arrlength = count($params[0]);
			for($x=0; $x<$arrlength; $x++) {
				$result = database::SQL("INSERT INTO `api_params`(`template_id`,`name`) VALUES(?,?)",array('is',$template_id,$params[0][$x]));
			}
			$output['error'] = false;
			$output['message'] = 'Template updated.';
		}
		else{
			//name is dfferent than previous name
			$result = database::SQL("SELECT `id` FROM `template` WHERE `name`=? LIMIT 1",array('s',$template_name));
			if(empty($result)){
				//template name not in use
				$result = database::SQL("UPDATE `template` SET `name`=?,`template`=?,`last_updated`=? WHERE `id`=?",array('ssii',$template_name,$template_text,$t,$template_id));
				//update parameter list
				$result = database::SQL("DELETE FROM `api_params` WHERE `template_id` = ?",array('i',$template_id));
				$arrlength = count($params[0]);
				for($x=0; $x<$arrlength; $x++) {
					$result = database::SQL("INSERT INTO `api_params`(`template_id`,`name`) VALUES(?,?)",array('is',$template_id,$params[0][$x]));
				}
				$output['error'] = false;
				$output['message'] = 'Template updated.';
			}
			else{
				//template name already in use
				$output['error'] = true;
				$output['message'] = 'Template name already in use.';
			}
		}	
	}
?>