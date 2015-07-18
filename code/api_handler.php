<?php
	$sessObj = new session();

	if (!$sessObj->state) {
    	redirect_to("index.php");
	}

	$id = session::getUserID();
	$newuser = new user($id);

	if(!isset($_GET['mail_id']) && !isset($_GET['err'])){
		$res = 'Call to API not found.';
		$error = true;
	}
	elseif (!isset($_GET['mail_id']) && isset($_GET['err'])) {
		$res = $_GET['err'];
		$error = true;
	}
	elseif (isset($_GET['mail_id']) && isset($_GET['err'])) {
		$res = 'Try calling an API first.';
		$error = true;
	}
	else{
		$result = database::SQL("SELECT `sent`,`campaign_id` FROM `mail` WHERE `id` = ? LIMIT 1",array('i',$_GET['mail_id']));
		if(!empty($result)){
			$sent = $result[0]['sent'];
			if(!empty($result[0]['campaign_id']) && $sent==0){
				$result = database::SQL("UPDATE `mail` SET `sent`=1 WHERE `id`=?",array('i',$_GET['mail_id']));
				$res = 'Mail pushed to queue.';
				$error = false;
			}
			elseif($sent == 1){
				$res = 'Mail already sent.';
				$error = true;
			}
			else{
				$res = 'Non existent entry in database.';
				$error = true;
			}
		}
		else{
			$res = 'Non existent entry in database.';
			$error = true;
		}
	}
		

$_API_HANDLER_ = true;  

?>