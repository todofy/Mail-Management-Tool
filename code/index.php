<?php
database::Start();
$sessObj = new session();

// Check if already logged in
if ($sessObj->state) {
    redirect_to("dashboard.php");
}

if(isset($_POST['commit'])) {
    $email = $_POST['login'];
    $password = $_POST['password'];

    if (login::login_user($email, $password, isset($_POST['remember_me']))) {
        redirect_to("dashboard.php");
    }

    $err = "Incorrect Email or Password";
}

$_CODE_INDEX_ = true;
?>