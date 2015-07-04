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
include __DIR__ .'/../libs/login.php';

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

$data = json_decode($_POST['data'], true);
if (!isset($data['category']) || !isset($data['data'])) {
	$output['error'] = true;
	$output['message'] = 'Invalid request made! Check data sent again!';
	echo json_encode($output);
	exit;
}

$category = $data['category'];
$data = $data['data'];

if($category == "change_pw"){
	$admin_id = session::getUserID();
	database::Start();
	include __DIR__ .'/change_pw.php';
	echo json_encode($output);
	exit;
}


// List of all access needed to perform action belonging to a category
$access_needed = array(
	'add_admin' => array(ADD_ADMIN),
	'edit_admin' => array(EDIT_ADMIN),
	'delete_admin' => array(DELETE_ADMIN),
	'revoke_admin' => array(REVOKE_ADMIN)
	);

if (!isset($access_needed[$category])) {
	$output['error'] = true;
	$output['message'] = 'Invalid category sent in request';
	echo json_encode($output);
	exit;
}

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

database::Start();
//$data = sanitize($data);

// perform rest of action in this page
include __DIR__ .'/' .$category .'.php';

echo json_encode($output);
exit;

?>

