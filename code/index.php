<?php
database::Start();
$sessObj = new session();

// Check if already logged in
if ($sessObj->state) {
    redirect_to("dashboard.php");
}

if(isset($_GET['err'])) $err = $_GET['err'];

if(isset($_POST['commit'])) {
    $email = $_POST['login'];
    $password = $_POST['password'];
    echo "Now";
    //if (login::login_user($email, $password, isset($_POST['remember_me']))) {
    	echo "Here";
        redirect_to("dashboard.php");
    //}
    echo "There";
    $err = "Incorrect Email or Password";
}
echo "Nowhere";
$_CODE_INDEX_ = true;
?>