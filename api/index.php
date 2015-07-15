/**
 * API handler
 */

<?php

session_start();
$SECURE = true;

// all the sdk includes
include __DIR__ .'/../libs/login.php';
include __DIR__ .'/../libs/api.php';

$secret_key = $_GET['secret_key'];
$api_name = $_GET['api_name'];
for ($i=2; $i < count($_GET); $i++) { 
	//store all parameters in $params array
}

$api = new api($secret_key,$api_name,$params);
$unique_id = login::getHash(8);
echo $api->response;

//send the object response to queue
?>
