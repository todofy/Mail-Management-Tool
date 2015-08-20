<?php
	//get template id, name, template text, time and parameters
	$template_id = $data['template-id'];
	$template_name = $data['template-name'];
	$template_text = $data['template-text'];
	$t = time();
	preg_match_all('/{{(.*?)}}/', $template_text, $params);
	preg_match_all('/href="(.*?)"/', $template_text, $links);

	$err1 = false;
	$err2 = false;
	foreach ($params[1] as $value) {
		if($value== "")
		{
			$err = true;
			break;
		}
		if($value=="to"){
			$err2 = true;
			break;
		}
	}
	if($err1)
	{
		$output['error'] = true;
		$output['message'] = 'Blank Parameters!';
	}
	elseif ($err2) {
		$output['error'] = true;
		$output['message'] = '\'to\' parameter is reserved.';
	}
	else
	{

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
			//update links
			$result = database::SQL("DELETE FROM `links` WHERE `template_id`=?",array('i',$template_id));
			$arrlength = count($links[0]);
			for($x=0; $x<$arrlength; $x++) {
				$check_string = substr($links[1][$x], 0 , 7);
				if($check_string != "mailto:")
					$result = database::SQL("INSERT INTO `links`(`href`,`url`,`template_id`) VALUES(?,?,?)",array('ssi',$links[0][$x],$links[1][$x],$template_id));
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
				//update links
				$result = database::SQL("DELETE FROM `links` WHERE `template_id`=?",array('i',$template_id));
				$arrlength = count($links[0]);
				for($x=0; $x<$arrlength; $x++) {
					$check_string = substr($links[1][$x], 0 , 7);
					if($check_string != "mailto:")
						$result = database::SQL("INSERT INTO `links`(`href`,`url`,`template_id`) VALUES(?,?,?)",array('ssi',$links[0][$x],$links[1][$x],$template_id));
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