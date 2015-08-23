<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	//Get the id of the api to be displayed
	$id = $_GET['id'];
	$result = database::SQL("SELECT `code`,`name`,`template_id` from `api` where `id` = ? LIMIT 1", array('i', $id));

	if(empty($result)) redirect_to("_404.php");
	else{
		$api_name = $result[0]['name'];
		$api_code = $result[0]['code'];
		$template_id = $result[0]['template_id'];
		//get template for the api
		$result = database::SQL("SELECT `template` from `template` where id = ? LIMIT 1", array('i',$template_id));
		$template_text = $result[0]['template'];
		//get all parameters for api
	    $result = database::SQL("SELECT `name` FROM `api_params` WHERE `template_id`=?",array('i',$template_id));

		//generate php example
		$php_example = '...*code*...';
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
	}
    
	$_API_VIEW_ = true;
?>