<?php
	//get template name, template text and parameters
	$template_name = $data['template-name'];
	$template_text = $data['template-text'];
	preg_match_all('/{{(.*?)}}/', $template_text, $params);
	preg_match_all('/href="(.*?)"/', $template_text, $links);	

	$err = false;
	foreach ($params[1] as $value) {
		if($value== "")
		{
			$err = true;
			break;
		}
	}
	if($err)
	{
		$output['error'] = true;
		$output['message'] = 'Blank Parameters!';
	}
	else
	{
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
			$template_id = $result[0]['id'];
			if($template_id == null){
				$output['error'] = true;
				$output['message'] = 'Database error! Unable to add template.';
			}
			else{
				//insert parameters in database
				$arrlength = count($params[0]);
				for($x=0; $x<$arrlength; $x++) {
					$result = database::SQL("INSERT INTO `api_params`(`template_id`,`name`) VALUES(?,?)",array('is',$template_id,$params[0][$x]));
				}
				//insert links in database
				$arrlength = count($links[0]);
				for($x=0; $x<$arrlength; $x++) {
					$link_hash = login::getHash(16);
					$result = database::SQL("INSERT INTO `links`(`url`,`hash`,`template_id`) VALUES(?,?,?)",array('ssi',$links[1][$x],$link_hash,$template_id));
				}
				$output['error'] = false;
				$output['message'] = 'Template added.';
			}
		}
	}
	
	
?>