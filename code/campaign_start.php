<?php
    $sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	//check if addding a campaign is a right
	/*
	if (!isset($newuser->access[ADD_CAMPAIGN])) {
		redirect_to("_404.php");
	}

	*/

	//validate the call
	if(isset($_POST['from']) && trim($_POST['from'])!="")
		$from = $_POST['from'];
	else
	{
		//get the default value
	}
	if(isset($_POST['subject'])&& trim($_POST['subject'])!="")
	{
		$subject = $_POST['subject'];
	}
	else
	{
		//get the default subject
	}
	$success = true;
	$err = "";
	if(isset($_POST['secret_key']))
	{
		//validate the secret key
		$result = database::SQL("SELECT `secret` FROM `admin` where `id` = ?" , array('i' , $id));
		if($result[0]['secret']!=$_POST['secret_key'])
		{
			$err = "wrong secret key";
			$success = false;
		}
		else
		{
			$secret_key = $_POST['secret_key'];
		}
	}
	
	if(isset($_POST['api']) && trim($_POST['api'])!="")
		$api = $_POST['api'];
	else
	{
		$success = false;
		$err = "No api selected";
	}
	if(isset($_POST['NO_Mails']) && trim($_POST['NO_Mails'])!="")
		$noOfMails = $_POST['NO_Mails'];
	else
	{
		$success = false;
		$err = "select no of mails to be sent";
	}
	//redirect if there is an error
	if(!$success)
		redirect_to('campaign_create.php?err='.$err);
	// get the template id
	$result = database::SQL("SELECT `template_id` FROM  `api` WHERE `code` = ? LIMIT 1" , array('s' , $api));
	$template_id = $result[0]['template_id'];
	//get the parameters
	$params = database::SQL("SELECT `name` FROM  `api_params` WHERE `template_id` = ?" , array('i' , $template_id));

	$_CAMPAIGN_START_ = true;
?>