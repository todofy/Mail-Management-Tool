<?php
/**
 * This file acts as reciever of every ajax request
 * and deals with reverting back to user
 */

session_start();
$SECURE = true;

// all the sdk includes
include __DIR__ .'/../libs/session.php';
include __DIR__ .'/../libs/database.php';
include __DIR__ .'/../libs/user.php';
include __DIR__ .'/../libs/logging.php';
include __DIR__ .'/../libs/login.php';
include __DIR__ .'/../libs/api.php';

// Function to recursively sanitize a data var
/*function sanitize($arr) {
	if (is_array($arr)) {
		foreach ($arr as $key => $value) {
			$arr[$key] = sanitize($value);
		}
	} else
		//causing error here: earlier used deprecated mysql_escape_string and now also an error 
		return database::con->real_escape_string($arr);
}
*/

$output = array(
	'error' => false,
	'message' => '',
	'logout' => false,
	'data' => null
	);


$sessObj = new session();
$data = json_decode($_POST['data'], true);
$category = $data['category'];
$data = $data['data'];

//forgot password call
//it does not require a session to be set
if($category == "forgot_pw")
{
	database::start();
	include __DIR__.'/forgot_pw.php';
	echo json_encode($output);
	exit;
}

//confirm password reset call 
//it does not require a session to be set
if($category == "reset_pw")
{
	database::Start();
	include __DIR__.'/reset_pw.php';
	echo json_encode($output);
	exit;
}
// If not logged in send back error message
if (!$sessObj->state) {
	$output['error'] = true;
	$output['message'] = 'Please login to perform this action!';
	echo json_encode($output);
	exit;
}

// Check if the request has required credentials
if (!isset($_POST['data'])) {
	$output['error'] = true;
	$output['message'] = 'Invalid request made! Check data sent again!';
	echo json_encode($output);
	exit;
}


if (!isset($data['category']) || !isset($data['data'])) {
	$output['error'] = true;
	$output['message'] = 'Invalid request made! Check data sent again!';
	echo json_encode($output);
	exit;
}



//change password call
if($category == "change_pw"){
	$admin_id = session::getUserID();
	database::Start();
	include __DIR__ .'/change_pw.php';
	echo json_encode($output);
	exit;
}

//delete account call
if($category == "delete_account"){
	$admin_id = session::getUserID();
	database::Start();
	include __DIR__ .'/delete_account.php';
	echo json_encode($output);
	exit;
}

//start campaign call
if($category == "campaign_start"){
	database::Start();
	include __DIR__ .'/campaign_start.php';
	echo json_encode($output);
	exit;
}

//unsubscription
if($category == "unsubscribe"){
	database::Start();
	include __DIR__ .'/unsubscribe.php';
	echo json_encode($output);
	exit;
}

//remove unsubscription
if($category == "remove_unsub"){
	database::Start();
	include __DIR__ .'/remove_unsub.php';
	echo json_encode($output);
	exit;
}

//List of all operations regarding templates
$template_operations = array(
	'view_template' => array('view_template'),
	'add_template' => array('add_template'),
	'edit_template' => array('edit_template'),
	'delete_template' => array('delete_template')
	);

//List of all operations regarding APIs
$api_operations = array(
	'add_api' => array('add_api'),
	'edit_api' => array('edit_api'),
	'delete_api' => array('delete_api')
	);

// List of all access needed to perform action belonging to a category
$access_needed = array(
	'add_admin' => array(ADD_ADMIN),
	'edit_admin' => array(EDIT_ADMIN),
	'delete_admin' => array(DELETE_ADMIN),
	'revoke_admin' => array(REVOKE_ADMIN)
	);

if (!isset($access_needed[$category]) && !isset($template_operations[$category]) && !isset($api_operations[$category])) {
	$output['error'] = true;
	$output['message'] = 'Invalid category sent in request';
	echo json_encode($output);
	exit;
}

if (isset($access_needed[$category])){
	$admin_id = session::getUserID();
	$newuser = new user($admin_id);

	foreach ($access_needed[$category] as $value) {
		if (!isset($newuser->access[$value])) {
			$output['error'] = true;
			$output['message'] = 'You do not have access to perform this action!';
			echo json_encode($output);
			exit;
		}
	}
}

database::Start();
//$data = sanitize($data);

// perform rest of action in this page
include __DIR__ .'/' .$category .'.php';

echo json_encode($output);
exit;

?>

