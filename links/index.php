<?php
session_start();
$SECURE = true;
include __DIR__ .'/../libs/globals.php';
include __DIR__ .'/../libs/session.php';
include __DIR__ .'/../libs/user.php';
include __DIR__ .'/../libs/database.php';


//get the hashed url
$hashed_url = $_GET['url'];

//verify the hash
$result = database::SQL("SELECT `link_id` , `mail_id` FROM `link_hash` WHERE `hash` = ? LIMIT 1" , array('s' , $hashed_url));
if(empty($result))
{
	//this link does not exist in the template
	//do something
	redirect_to('http://localhost/Mail-Management-Tool/_404.php');
}
else
{
	$link_id = $result[0]['link_id'];
	$mail_id = $result[0]['mail_id'];
	//increment its click counter
	$result = database::SQL("UPDATE `link_hash` SET `clicks` = `clicks`+1 WHERE `link_id` = ? AND `mail_id` = ?" , array('ii' , $link_id, $mail_id)); 

	//now redirect to the original link
	$result = database::SQL("SELECT `url` FROM `links` WHERE `id`=? LIMIT 1",array('i',$link_id));
	$url = $result[0]['url'];
	redirect_to($url);
}