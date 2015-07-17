<?php
/**
 * API handler
 */

session_start();
$SECURE = true;

// all the sdk includes
include __DIR__ .'/../libs/login.php';
include __DIR__ .'/../libs/api.php';

foreach ($_GET as $key => $value){
	$query[] = $value;
}

$secret_key = $query[0];
$api_name = $query[1];
for ($i=2; $i < count($query); $i++) { 
	$params[] = $query[$i];
}


$api = new api($secret_key,$api_name,$params);
$unique_id = login::getHash(8);

if($api->validate_call()){
	echo $api->replace_params;
}

?>
