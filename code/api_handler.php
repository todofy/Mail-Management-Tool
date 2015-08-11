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
		if($_GET['err'] == 'true'){
			$res = $_GET['msg'];
			$error = true;
		}
		else{
			$res = $_GET['msg'];
			$error = false;	
		}	
	}
		

$_API_HANDLER_ = true;  

?>