<?php
$sessObj = new session();

if (!$sessObj->state) {
	redirect_to("index.php");
}
$id = session::getUserID();
$newuser = new user($id);

$getKey = $_POST['key'];
$search_key = "%".$getKey."%";
//check if that id , admin email exists in the database
$search_result = array();
$result = database::SQL("SELECT `email` FROM `admin` WHERE `email` LIKE ? " , array('s' , $search_key) );
if(!empty($result))
{
	$adminURL = 'admin_view.php';
	foreach ($result as $key => $value) {
		$search_result[] = array('type'=> 'Admin' , 'link'=> $adminURL , 'value' =>$value['email']); 
	}
	
}
//now check if such api exists
$result = database::SQL("SELECT `code` , `name` FROM `api` WHERE `code` LIKE ? OR `name` LIKE ?" , array('ss' , $search_key , $search_key) );
if(!empty($result))
{
	$apiURL = 'api.php';
	foreach ($result as $key => $value) {
		$search_result[] = array('type'=> 'Api' , 'link'=> $apiURL , 'value' =>$value['name']); 
	}
	
}
//search for any such template names
$result = database::SQL("SELECT `name` FROM `template` WHERE `name` LIKE ?" , array('s' , $search_key) );
if(!empty($result))
{
	$templateURL = 'template.php';
	foreach ($result as $key => $value) {
		$search_result[] = array('type'=> 'Template' , 'link'=> $templateURL , 'value' =>$value['name']); 
	}
	
}
//search for any such campaign id
$result = database::SQL("SELECT `id` FROM `campaign` WHERE `id` LIKE ?" , array('s' , $search_key) );
if(!empty($result))
{
	$campaignURL = 'campaign_view.php';
	foreach ($result as $key => $value) {
		$search_result[] = array('type'=> 'campaign' , 'link'=> $campaignURL , 'value' =>$value['id']); 
	}
	
}

$_SEARCH_VIEW_ = true;
?>