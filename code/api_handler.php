<?php
	$sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	if(!isset($_GET['err']) || !isset($_GET['msg'])){
		$res = 'Call to API not found.';
		$error = true;
	}
	else{
		if($_GET['err']){
			$res = $_GET['msg'];
			$error = true;
		}
		else{
			$campaign_id = $_GET['msg'];
			$res = 'Campaign started with campaign_id: <a href="campaign_view.php?id='.$campaign_id.'">'.$campaign_id.'</a>';
			$error = false;	
		}	
	}
		

$_API_HANDLER_ = true;  

?>