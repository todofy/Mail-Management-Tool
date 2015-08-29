<?php

$post = "data=".$data;

$url = CAMPAIGN_START;

$request=curl_init();
curl_setopt($request, CURLOPT_URL, $url);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($request, CURLOPT_POST, 1);
curl_setopt($request, CURLOPT_POSTFIELDS, $post);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
$reply=curl_exec($request);
curl_close($request);

$reply = json_decode($reply,true);

if($reply['error']){
	$output['error'] = true;
	$output['message'] = $reply['message'];
}
else{
	$output['error'] = false;
	$output['message'] = 'Campaign started with #ID: '.$reply['message'];
}

?>