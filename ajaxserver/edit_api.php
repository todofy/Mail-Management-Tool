<?php
	//get api name and template name
	$api_id = $data['api-id'];
	$api_name = $data['api-name'];
	$template_name = $data['template'];

	//get id of template
	$result = database::SQL("SELECT `id` FROM `template` WHERE `name` = ? LIMIT 1",array('s',$template_name));
	$template_id = $result[0]['id'];

	$result = database::SQL("SELECT `name` FROM `api` WHERE `id`=? LIMIT 1",array('i',$api_id));
	$name = $result[0]['name'];
	if($name == $api_name){
		//name is same as previous name
		$result = database::SQL("UPDATE `api` SET `template_id`=? WHERE `id`=?",array('ii',$template_id,$api_id));
		//get all api parameters
		$result = database::SQL("SELECT `name` FROM `api_params` WHERE `template_id`=?",array('i',$template_id));
		//get url
		$api_call = 'localhost/Mail-Management-Tool/'.$api_name.'?';
		foreach ($result as $value) {
			$api_call = $api_call.$value['name'].'="value"&';
		}
		$api_call = rtrim($api_call,"&");
		//set output
		$output['error'] = false;
		$output['data'] = array($api_call, $template_text);
	}
	else{
		//name is dfferent than previous name
		$result = database::SQL("SELECT `id` FROM `api` WHERE `name`=? LIMIT 1",array('s',$api_name));
		if(empty($result)){
			//template name not in use
			$result = database::SQL("UPDATE `api` SET `name`=?,`template_id`=? WHERE `id`=?",array('sii',$api_name,$template_id,$api_id));
			//get all api parameters
			$result = database::SQL("SELECT `name` FROM `api_params` WHERE `template_id`=?",array('i',$template_id));
			//get url
			$api_call = 'localhost/Mail-Management-Tool/'.$api_name.'?';
			foreach ($result as $value) {
				$api_call = $api_call.$value['name'].'="value"&';
			}
			$api_call = rtrim($api_call,"&");
			//set output
			$output['error'] = false;
			$output['data'] = array($api_call, $template_text);
		}
		else{
			//API name already in use
			$output['error'] = true;
			$output['message'] = 'API name already in use.';
		}
	}
?>