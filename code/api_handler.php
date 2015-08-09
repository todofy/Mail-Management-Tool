<?php
	$sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	if(!isset($_GET['campaign_id']) && !isset($_GET['err'])){
		$res = 'Call to API not found.';
		$error = true;
	}
	elseif (!isset($_GET['campaign_id']) && isset($_GET['err'])) {
		$res = $_GET['err'];
		$error = true;
	}
	elseif (isset($_GET['campaign_id']) && isset($_GET['err'])) {
		$res = 'Try calling an API first.';
		$error = true;
	}
	else{
		$result = database::SQL("SELECT `id` FROM `campaign` WHERE `id` = ? LIMIT 1",array('i',$_GET['campaign_id']));
		if(!empty($result)){
			$campaign_id = $result[0]['id'];
			$res = 'Campaign started with id='.$campaign_id;
			$error = false;			
		}
		else{
			$res = 'Non existent entry in database.';
			$error = true;
		}
	}
		

$_API_HANDLER_ = true;  

?>