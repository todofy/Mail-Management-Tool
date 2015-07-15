<?php
	//get api name and template name
	$api_id = $data['api-id'];
	$api_name = $data['api-name'];
	$template_name = $data['template'];

	//get id and template_text of template
	$result = database::SQL("SELECT `id`,`template` FROM `template` WHERE `name` = ? LIMIT 1",array('s',$template_name));
	$template_id = $result[0]['id'];
	$template_text = $result[0]['template'];

	$result = database::SQL("SELECT `name` FROM `api` WHERE `id`=? LIMIT 1",array('i',$api_id));
	$name = $result[0]['name'];
	if($name == $api_name){
		//name is same as previous name
		$result = database::SQL("UPDATE `api` SET `template_id`=? WHERE `id`=?",array('ii',$template_id,$api_id));
		//get all api parameters
		$result = database::SQL("SELECT `name` FROM `api_params` WHERE `template_id`=?",array('i',$template_id));
		//get url
		$api_call = 'localhost/Mail-Management-Tool/api/index.php?secret_key="value"&api_name='.$api_name.'&';
		foreach ($result as $value) {
			$value['name'] = trim($value['name'],"{}");
			$api_call = $api_call.$value['name'].'="value"&';
		}
		$api_call = rtrim($api_call,"&");
		
		//generate php example
		$php_example ='...*code*...';
		$php_example = $php_example.'<br>';
		$php_example = $php_example.'$api = new api("secret_key","'.$api_name.'",';
		$php_example = $php_example.'<br>';
		$php_example = $php_example.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$php_example = $php_example.'array(<br>';
		foreach ($result as $value) {
			$value['name'] = trim($value['name'],"{}");
			$php_example = $php_example.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"'.$value['name'].'",<br>';
		}
		$php_example = rtrim($php_example,",<br>");
		$php_example = $php_example.'));';
		$php_example = $php_example.'<br>';
		$php_example = $php_example.'...*code*...';
		
		//set output
		$output['error'] = false;
		$output['data'] = array($api_call, $template_text, $php_example);
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
			$api_call = 'localhost/Mail-Management-Tool/api/index.php?secret_key="value"&api_name='.$api_name.'&';
			foreach ($result as $value) {
				$value['name'] = trim($value['name'],"{}");
				$api_call = $api_call.$value['name'].'="value"&';
			}
			$api_call = rtrim($api_call,"&");

			//generate php example
			$php_example ='...*code*...';
			$php_example = $php_example.'<br>';
			$php_example = $php_example.'$api = new api("secret_key","'.$api_name.'",';
			$php_example = $php_example.'<br>';
			$php_example = $php_example.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			$php_example = $php_example.'array(<br>';
			foreach ($result as $value) {
				$value['name'] = trim($value['name'],"{}");
				$php_example = $php_example.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"'.$value['name'].'",<br>';
			}
			$php_example = rtrim($php_example,",<br>");
			$php_example = $php_example.'));';
			$php_example = $php_example.'<br>';
			$php_example = $php_example.'...*code*...';
			
			//set output
			$output['error'] = false;
			$output['data'] = array($api_call, $template_text, $php_example);
		}
		else{
			//API name already in use
			$output['error'] = true;
			$output['message'] = 'API name already in use.';
		}
	}
?>