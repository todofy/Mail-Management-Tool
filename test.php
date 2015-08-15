<?php
session_start();
$SECURE = true;
include __DIR__ .'/libs/globals.php';
include __DIR__ .'/libs/session.php';
include __DIR__ .'/libs/user.php';

$data = array('secret_key' => '7be1f7a994a0cb2d9921a19fef9c52ae', 'api_code' => '12aed', 'subject' => 'Test mail','from' => 'abc@gmail.com',
				'payload' => array(
					array('to' => 'someone@example.com','param1' => 'dummy1'),
					array('to' => 'mno@gmail.com', 'param1' => 'dummy2'),
					array('to' => 'mert@gmail.com', 'param1' => 'dummy3')
					));

$jsonData = json_encode($data);

//echo $jsonData;

$url = "http://localhost/Mail-Management-Tool/api/";

$post = "data=".$jsonData;

$request=curl_init();
curl_setopt($request, CURLOPT_URL, $url);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($request, CURLOPT_POST, 1);
curl_setopt($request, CURLOPT_POSTFIELDS, $post);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
$reply=curl_exec($request);
curl_close($request);

$reply = json_decode($reply,true);

$err = $reply['error'];
$msg = $reply['message'];
redirect_to('api_handler.php?err='.$err.'&msg='.$msg);

exit;
?>