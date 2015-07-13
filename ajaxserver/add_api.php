<?php
	//get api name and template name
	$api_name = $data['api-name'];
	$template_name = $data['template'];

	//get id,template_text of template
	$result = database::SQL("SELECT `id`,`template` FROM `template` WHERE `name` = ? LIMIT 1",array('s',$template_name));
	$template_id = $result[0]['id'];
	$template_text = $result[0]['template'];

	//check if api name already in use or not
	$result = database::SQL("SELECT `id` from `api` where `name` = ? LIMIT 1",array('s',$api_name));
	if(!empty($result)){
		$output['error'] = true;
		$output['message'] = 'API name already in use!';
	}
	else{
		//insert the new api in the database
		$t = time();
		$code = login::getHash(5);
		$result = database::SQL("INSERT INTO `api`(`code`, `name` , `template_id` , `created_on`) VALUES(?,?,?,?)",array('ssii',$code,$api_name,$template_id,$t));

		//check if api is successfully inserted or not
		$result = database::SQL("SELECT `id` from `api` where `name` = ? LIMIT 1",array('s',$api_name));
		$id = $result[0]['id'];
		if($id == null){
			$output['error'] = true;
			$output['message'] = 'Database error! Unable to add API.';
		}
		else{
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
	}
?>