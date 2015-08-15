<?php
session_start();
$SECURE=true;

// all the sdk includes
include __DIR__ .'/libs/session.php';
include __DIR__ .'/libs/database.php';
include __DIR__ .'/libs/user.php';

$mail_id = $_GET['id'];

$result = database::SQL("SELECT `payload` FROM `mail` WHERE `id`=? LIMIT 1",array('i',$mail_id));

$payload = json_decode($result[0]['payload'],true);

$email = $payload['to'];

$result = database::SQL("SELECT `user_id` FROM `unsubscribed` WHERE `email`=? LIMIT 1",array('s',$email));
if (empty($result)) {
	$result = database::SQL("INSERT INTO `unsubscribed`(`email`) VALUES(?)",array('s',$email));
}
else{
	redirect_to('_404.php');
}

?>

<script type="text/javascript">
	alert('You have unsubscribed from this mailing engine.')
</script>

