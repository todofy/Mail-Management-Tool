<?php
session_start();
$SECURE = true;
include __DIR__ .'/../libs/globals.php';
include __DIR__ .'/../libs/session.php';
include __DIR__ .'/../libs/user.php';
include __DIR__ .'/../libs/database.php';


//get the hashed url
$hashed_url = $_GET['url'];
$hash1 = substr($hashed_url , 0 , 16);
$hash2 = substr($hashed_url , 17 , 16);

//verify the hashes
$result = database::SQL("SELECT `id` , `url` , `template_id` FROM `links` WHERE `hash` = ? LIMIT 1" , array('s' , $hash1));
if(empty($result))
{
	//this link does not exist in the template
	//do something
}
else
{
	$id = $result[0]['id'];
	$url = $result[0]['url'];
	$template_id = $result[0]['template_id'];
	//increment its counter as a link 
	$result = database::SQL("UPDATE `links` set clicks = clicks+1 WHERE `id` = ?" , array('i' , $id)); 
	//increment the counter for the particular mail
	//do something

	//now redirect to the original link
	redirect_to($url);
}